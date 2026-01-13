<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->latest()->get();
        $categories = Category::withCount('books')->get();

        return view('dashboard', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        // Prepare data - convert empty ISBN to null
        $data = $request->all();
        $data['isbn'] = !empty($data['isbn']) && trim($data['isbn']) !== '' ? trim($data['isbn']) : null;
        $data['description'] = null; // Description not required in add form

        $validated = validator($data, [
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    // Check if book with same title and author already exists (case-insensitive)
                    $existingBook = Book::whereRaw('LOWER(title) = LOWER(?)', [$value])
                        ->whereRaw('LOWER(author) = LOWER(?)', [$request->author])
                        ->first();
                    
                    if ($existingBook) {
                        $fail('This book already exists in the library. A book with the same title and author cannot be added.');
                    }
                },
            ],
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
            'published_date' => 'required|date',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ])->validate();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('books', 'public');
            $validated['photo'] = $photoPath;
        }

        Book::create($validated);

        return redirect()->back()->with('success', 'Book added successfully.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request, $book) {
                    // Check if book with same title and author already exists (excluding current book, case-insensitive)
                    $existingBook = Book::whereRaw('LOWER(title) = LOWER(?)', [$value])
                        ->whereRaw('LOWER(author) = LOWER(?)', [$request->author])
                        ->where('id', '!=', $book->id)
                        ->first();
                    
                    if ($existingBook) {
                        $fail('This book already exists in the library. A book with the same title and author cannot be added.');
                    }
                },
            ],
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:books,isbn,' . $book->id,
            'category_id' => 'required|exists:categories,id',
            'published_date' => 'nullable|date',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Handle photo upload (takes precedence over removal)
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($book->photo && Storage::disk('public')->exists($book->photo)) {
                Storage::disk('public')->delete($book->photo);
            }
            
            $photo = $request->file('photo');
            $photoPath = $photo->store('books', 'public');
            $validated['photo'] = $photoPath;
        }
        // Handle photo removal (only if no new photo was uploaded)
        elseif ($request->has('remove_photo') && $request->remove_photo == '1') {
            // Delete old photo if exists
            if ($book->photo && Storage::disk('public')->exists($book->photo)) {
                Storage::disk('public')->delete($book->photo);
            }
            $validated['photo'] = null;
        }

        $book->update($validated);

        return redirect()->back()->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete(); // Soft delete

        return redirect()->back()->with('success', 'Book moved to trash successfully.');
    }

    public function exportPdf(Request $request)
    {
        $query = Book::with('category');

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->latest()->get();

        $pdf = Pdf::loadView('pdf.books', compact('books'));
        
        $filename = 'The Book Lists_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
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
        ])->validate();

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
        ]);

        $book->update($validated);

        return redirect()->back()->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back()->with('success', 'Book deleted successfully.');
    }
}

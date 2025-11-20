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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:255|unique:books,isbn',
            'category_id' => 'nullable|exists:categories,id',
            'published_date' => 'nullable|date',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Book::create($validated);

        return redirect()->back()->with('success', 'Book added successfully.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
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

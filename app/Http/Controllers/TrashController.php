<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    public function index()
    {
        $books = Book::onlyTrashed()->with('category')->latest('deleted_at')->get();
        $categories = Category::all();

        return view('trash', compact('books', 'categories'));
    }

    public function restore($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return redirect()->back()->with('success', 'Book restored successfully.');
    }

    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        
        // Delete photo if exists
        if ($book->photo && Storage::disk('public')->exists($book->photo)) {
            Storage::disk('public')->delete($book->photo);
        }
        
        $book->forceDelete();

        return redirect()->back()->with('success', 'Book permanently deleted.');
    }
}

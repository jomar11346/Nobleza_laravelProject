<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '978-0-7432-7356-5',
                'category_id' => $categories->where('name', 'Fiction')->first()->id ?? null,
                'published_date' => '1925-04-10',
                'quantity' => 5,
                'description' => 'A classic American novel set in the Jazz Age',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '978-0-452-28423-4',
                'category_id' => $categories->where('name', 'Science Fiction')->first()->id ?? null,
                'published_date' => '1949-06-08',
                'quantity' => 8,
                'description' => 'A dystopian social science fiction novel',
            ],
            [
                'title' => 'The Murder of Roger Ackroyd',
                'author' => 'Agatha Christie',
                'isbn' => '978-0-06-207378-5',
                'category_id' => $categories->where('name', 'Mystery')->first()->id ?? null,
                'published_date' => '1926-06-01',
                'quantity' => 3,
                'description' => 'A detective novel featuring Hercule Poirot',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '978-0-06-231609-7',
                'category_id' => $categories->where('name', 'Non-Fiction')->first()->id ?? null,
                'published_date' => '2011-01-01',
                'quantity' => 6,
                'description' => 'A book exploring how Homo sapiens came to dominate the world',
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'isbn' => '978-1-4516-4853-9',
                'category_id' => $categories->where('name', 'Biography')->first()->id ?? null,
                'published_date' => '2011-10-24',
                'quantity' => 4,
                'description' => 'The exclusive biography of the Apple co-founder',
            ],
            [
                'title' => 'The Guns of August',
                'author' => 'Barbara W. Tuchman',
                'isbn' => '978-0-345-47609-8',
                'category_id' => $categories->where('name', 'History')->first()->id ?? null,
                'published_date' => '1962-01-01',
                'quantity' => 2,
                'description' => 'A history of the first month of World War I',
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'isbn' => '978-0-441-17271-9',
                'category_id' => $categories->where('name', 'Science Fiction')->first()->id ?? null,
                'published_date' => '1965-08-01',
                'quantity' => 7,
                'description' => 'An epic science fiction novel set on the desert planet Arrakis',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

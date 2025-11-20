<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Imaginative works of prose, especially novels and short stories',
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Books based on facts, real events, and real people',
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Fiction based on imagined future scientific or technological advances',
            ],
            [
                'name' => 'Mystery',
                'description' => 'Fiction dealing with the solution of a crime or the unraveling of secrets',
            ],
            [
                'name' => 'Biography',
                'description' => 'An account of someone\'s life written by someone else',
            ],
            [
                'name' => 'History',
                'description' => 'Books about past events, particularly in human affairs',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

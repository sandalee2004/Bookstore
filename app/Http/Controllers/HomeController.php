<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured books with their relationships
        $featuredBooks = Book::with(['author', 'category'])
            ->active()
            ->featured()
            ->inStock()
            ->limit(8)
            ->get();

        // Get all active categories with book count
        $categories = Category::active()
            ->withCount('books')
            ->orderBy('name')
            ->get();

        // If no featured books, get some random popular books
        if ($featuredBooks->isEmpty()) {
            $featuredBooks = Book::with(['author', 'category'])
                ->active()
                ->inStock()
                ->orderBy('rating', 'desc')
                ->limit(8)
                ->get();
        }

        return view('home', compact('featuredBooks', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('books.index');
        }

        $books = Book::with(['author', 'category'])
            ->active()
            ->where(function ($q) use ($query) {
                $q->where('title', 'ILIKE', "%{$query}%")
                  ->orWhere('description', 'ILIKE', "%{$query}%")
                  ->orWhere('isbn', 'ILIKE', "%{$query}%")
                  ->orWhereHas('author', function ($authorQuery) use ($query) {
                      $authorQuery->where('name', 'ILIKE', "%{$query}%");
                  })
                  ->orWhereHas('category', function ($categoryQuery) use ($query) {
                      $categoryQuery->where('name', 'ILIKE', "%{$query}%");
                  });
            })
            ->paginate(12);

        return view('books.index', compact('books', 'query'));
    }
}
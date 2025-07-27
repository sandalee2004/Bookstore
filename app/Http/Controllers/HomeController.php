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
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['books' => []]);
            }
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
            ->limit(10)
            ->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'books' => $books->map(function ($book) {
                    return [
                        'id' => $book->id,
                        'title' => $book->title,
                        'slug' => $book->slug,
                        'author' => $book->author,
                        'category' => $book->category,
                        'price' => $book->price,
                        'final_price' => $book->final_price,
                        'cover_image' => $book->cover_image,
                    ];
                })
            ]);
        // For non-AJAX requests, paginate and return view
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
        }
        return view('books.index', compact('books', 'query'));
    }
}
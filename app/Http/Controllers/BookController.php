<?php
// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['author', 'category'])->where('is_active', true);

        // Get filter options
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by author
        if ($request->has('author') && $request->author) {
            $author = Author::where('slug', $request->author)->first();
            if ($author) {
                $query->where('author_id', $author->id);
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'ILIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'ILIKE', "%{$searchTerm}%")
                  ->orWhereHas('author', function ($authorQuery) use ($searchTerm) {
                      $authorQuery->where('name', 'ILIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Price range filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Quick filters
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }
        if ($request->has('on_sale') && $request->on_sale) {
            $query->whereNotNull('discount_price');
        }
        if ($request->has('in_stock') && $request->in_stock) {
            $query->where('stock_quantity', '>', 0);
        }

        // Sort options
        $sortBy = $request->get('sort', 'title');
        $sortOrder = $request->get('order', 'asc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortOrder);
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $query->orderBy('reviews_count', 'desc');
                break;
            default:
                $query->orderBy('title', $sortOrder);
        }

        $books = $query->paginate(12)->withQueryString();

        return view('books.index', compact('books', 'categories', 'authors'));
    }

    public function show($slug)
    {
        $book = Book::with(['author', 'category'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related books (same category, different book)
        $relatedBooks = Book::with(['author', 'category'])
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->limit(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }

    public function quickView($id)
    {
        $book = Book::with(['author', 'category'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'book' => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author->name,
                'category' => $book->category->name,
                'price' => $book->price,
                'discount_price' => $book->discount_price,
                'final_price' => $book->final_price,
                'cover_image' => $book->cover_image,
                'description' => $book->description,
                'rating' => $book->rating,
                'reviews_count' => $book->reviews_count,
                'is_in_stock' => $book->is_in_stock,
                'stock_quantity' => $book->stock_quantity,
            ]
        ]);
    }
}
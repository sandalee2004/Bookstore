<?php
// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->withCount('books')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();
        
        $books = Book::with(['author', 'category'])
            ->where('category_id', $category->id)
            ->active()
            ->paginate(12);

        return view('categories.show', compact('category', 'books'));
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')
            ->orderBy('name')
            ->paginate(12);

        return view('authors.index', compact('authors'));
    }

    public function show($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();
        
        $books = Book::with(['author', 'category'])
            ->where('author_id', $author->id)
            ->where('is_active', true)
            ->paginate(12);

        return view('authors.show', compact('author', 'books'));
    }
}

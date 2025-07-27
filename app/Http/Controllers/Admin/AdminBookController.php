<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['author', 'category']);

        if ($request->search) {
            $query->where('title', 'ILIKE', "%{$request->search}%")
                  ->orWhere('isbn', 'ILIKE', "%{$request->search}%");
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        $books = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::all();

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $authors = Author::all();
        
        return view('admin.books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn' => 'required|string|unique:books',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'cover_image' => 'required|url',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string',
            'publication_date' => 'nullable|date',
            'publisher' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'isbn' => $request->isbn,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock_quantity' => $request->stock_quantity,
            'cover_image' => $request->cover_image,
            'pages' => $request->pages,
            'language' => $request->language,
            'publication_date' => $request->publication_date,
            'publisher' => $request->publisher,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'category']);
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::where('is_active', true)->get();
        $authors = Author::all();
        
        return view('admin.books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'cover_image' => 'required|url',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string',
            'publication_date' => 'nullable|date',
            'publisher' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'isbn' => $request->isbn,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock_quantity' => $request->stock_quantity,
            'cover_image' => $request->cover_image,
            'pages' => $request->pages,
            'language' => $request->language,
            'publication_date' => $request->publication_date,
            'publisher' => $request->publisher,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully.'
        ]);
    }

    public function toggleStatus(Book $book)
    {
        $book->update(['is_active' => !$book->is_active]);
        
        $status = $book->is_active ? 'activated' : 'deactivated';
        return response()->json([
            'success' => true,
            'message' => "Book {$status} successfully."
        ]);
    }
}


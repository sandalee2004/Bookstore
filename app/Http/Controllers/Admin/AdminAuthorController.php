<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminAuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::withCount('books');

        if ($request->search) {
            $query->where('name', 'ILIKE', "%{$request->search}%")
                  ->orWhere('nationality', 'ILIKE', "%{$request->search}%");
        }

        $authors = $query->orderBy('name')->paginate(15);

        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'photo' => 'nullable|url',
            'birth_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
        ]);

        Author::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'biography' => $request->biography,
            'photo' => $request->photo,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully.');
    }

    public function show(Author $author)
    {
        $author->load(['books' => function($query) {
            $query->with('category')->latest()->take(10);
        }]);
        return view('admin.authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'photo' => 'nullable|url',
            'birth_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
        ]);

        $author->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'biography' => $request->biography,
            'photo' => $request->photo,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->books()->count() > 0) {
            return back()->with('error', 'Cannot delete author with existing books.');
        }

        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully.');
    }
}
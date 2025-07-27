@extends('layouts.app')

@section('title', 'Add New Book - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Book</h1>
                <p class="text-gray-600">Add a new book to your inventory</p>
            </div>
            <a href="{{ route('admin.books.index') }}" class="btn btn-outline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Books
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.books.store') }}" class="space-y-8">
                @csrf

                <!-- Basic Information -->
                <div>
                    <h2 class="text-xl font-semibold mb-6">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Book Title *</label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required
                                   class="input-field @error('title') border-red-500 @enderror"
                                   placeholder="Enter book title">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="author_id" class="block text-sm font-medium text-gray-700 mb-2">Author *</label>
                            <select id="author_id" 
                                    name="author_id" 
                                    required
                                    class="input-field @error('author_id') border-red-500 @enderror">
                                <option value="">Select an author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select id="category_id" 
                                    name="category_id" 
                                    required
                                    class="input-field @error('category_id') border-red-500 @enderror">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4" 
                                      required
                                      class="input-field @error('description') border-red-500 @enderror"
                                      placeholder="Enter book description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Publication Details -->
                <div>
                    <h2 class="text-xl font-semibold mb-6">Publication Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN *</label>
                            <input type="text" 
                                   id="isbn" 
                                   name="isbn" 
                                   value="{{ old('isbn') }}" 
                                   required
                                   class="input-field @error('isbn') border-red-500 @enderror"
                                   placeholder="Enter ISBN">
                            @error('isbn')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Language *</label>
                            <input type="text" 
                                   id="language" 
                                   name="language" 
                                   value="{{ old('language', 'English') }}" 
                                   required
                                   class="input-field @error('language') border-red-500 @enderror"
                                   placeholder="Enter language">
                            @error('language')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pages" class="block text-sm font-medium text-gray-700 mb-2">Pages</label>
                            <input type="number" 
                                   id="pages" 
                                   name="pages" 
                                   value="{{ old('pages') }}" 
                                   min="1"
                                   class="input-field @error('pages') border-red-500 @enderror"
                                   placeholder="Number of pages">
                            @error('pages')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">Publisher</label>
                            <input type="text" 
                                   id="publisher" 
                                   name="publisher" 
                                   value="{{ old('publisher') }}" 
                                   class="input-field @error('publisher') border-red-500 @enderror"
                                   placeholder="Enter publisher">
                            @error('publisher')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="publication_date" class="block text-sm font-medium text-gray-700 mb-2">Publication Date</label>
                            <input type="date" 
                                   id="publication_date" 
                                   name="publication_date" 
                                   value="{{ old('publication_date') }}" 
                                   class="input-field @error('publication_date') border-red-500 @enderror">
                            @error('publication_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing & Inventory -->
                <div>
                    <h2 class="text-xl font-semibold mb-6">Pricing & Inventory</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                            <input type="number" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price') }}" 
                                   step="0.01" 
                                   min="0" 
                                   required
                                   class="input-field @error('price') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="discount_price" class="block text-sm font-medium text-gray-700 mb-2">Discount Price ($)</label>
                            <input type="number" 
                                   id="discount_price" 
                                   name="discount_price" 
                                   value="{{ old('discount_price') }}" 
                                   step="0.01" 
                                   min="0"
                                   class="input-field @error('discount_price') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('discount_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                            <input type="number" 
                                   id="stock_quantity" 
                                   name="stock_quantity" 
                                   value="{{ old('stock_quantity') }}" 
                                   min="0" 
                                   required
                                   class="input-field @error('stock_quantity') border-red-500 @enderror"
                                   placeholder="0">
                            @error('stock_quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Cover Image -->
                <div>
                    <h2 class="text-xl font-semibold mb-6">Cover Image</h2>
                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image URL *</label>
                        <input type="url" 
                               id="cover_image" 
                               name="cover_image" 
                               value="{{ old('cover_image') }}" 
                               required
                               class="input-field @error('cover_image') border-red-500 @enderror"
                               placeholder="https://example.com/book-cover.jpg">
                        @error('cover_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Enter a valid URL for the book cover image</p>
                    </div>
                </div>

                <!-- Settings -->
                <div>
                    <h2 class="text-xl font-semibold mb-6">Settings</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Active (visible to customers)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_featured" 
                                   name="is_featured" 
                                   value="1"
                                   {{ old('is_featured') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                Featured (show on homepage)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Book
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
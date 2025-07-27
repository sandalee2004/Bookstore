@extends('layouts.app')

@section('title', $author->name . ' - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $author->name }}</h1>
                <p class="text-gray-600">Author Details</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Author
                </a>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Authors
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Author Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="text-center mb-6">
                        <div class="w-32 h-32 mx-auto mb-4 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center overflow-hidden">
                            @if($author->photo)
                                <img src="{{ $author->photo }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            @endif
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $author->name }}</h2>
                        @if($author->nationality)
                            <p class="text-gray-600">{{ $author->nationality }}</p>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $author->slug }}</p>
                        </div>
                        
                        @if($author->birth_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Birth Date</label>
                            <p class="text-gray-900">{{ $author->birth_date->format('M d, Y') }}</p>
                        </div>
                        @endif
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Total Books</label>
                            <p class="text-2xl font-bold text-blue-600">{{ $author->books_count }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Added</label>
                            <p class="text-gray-900">{{ $author->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('books.index', ['author' => $author->slug]) }}" 
                           target="_blank"
                           class="btn btn-outline w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            View on Site
                        </a>
                        
                        @if($author->books_count === 0)
                            <button onclick="deleteAuthor({{ $author->id }})" 
                                    class="btn bg-red-600 text-white hover:bg-red-700 w-full">
                                Delete Author
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Author Biography and Books -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Biography -->
                @if($author->biography)
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Biography</h2>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {{ $author->biography }}
                    </div>
                </div>
                @endif

                <!-- Books by Author -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Books by {{ $author->name }}</h2>
                    
                    @if($author->books->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($author->books as $book)
                                <div class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg">
                                    <img src="{{ $book->cover_image }}" 
                                         alt="{{ $book->title }}" 
                                         class="w-12 h-16 object-cover rounded">
                                    
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-gray-900 truncate">{{ $book->title }}</h3>
                                        <p class="text-sm text-gray-600">{{ $book->category->name }}</p>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="text-sm font-medium text-blue-600">${{ number_format($book->final_price, 2) }}</span>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $book->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $book->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col space-y-1">
                                        <a href="{{ route('admin.books.show', $book) }}" 
                                           class="text-blue-600 hover:text-blue-700 text-xs">
                                            View
                                        </a>
                                        <a href="{{ route('admin.books.edit', $book) }}" 
                                           class="text-indigo-600 hover:text-indigo-700 text-xs">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($author->books_count > 10)
                            <div class="text-center mt-6">
                                <a href="{{ route('admin.books.index', ['author' => $author->slug]) }}" 
                                   class="btn btn-outline">
                                    View All Books ({{ $author->books_count }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">No books by this author</h3>
                            <p class="text-gray-500 mb-4">Add books by this author to see them here.</p>
                            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                                Add New Book
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function deleteAuthor(authorId) {
        if (confirm('Are you sure you want to delete this author? This action cannot be undone.')) {
            fetch(`/admin/authors/${authorId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Author deleted successfully', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.authors.index") }}';
                    }, 1000);
                } else {
                    showToast('Error deleting author', 'error');
                }
            })
            .catch(error => {
                showToast('Error deleting author', 'error');
            });
        }
    }
</script>
@endpush
@endsection
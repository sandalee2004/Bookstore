@extends('layouts.app')

@section('title', 'Manage Authors - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Manage Authors</h1>
                <p class="text-gray-600">Add and manage book authors</p>
            </div>
            <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Author
            </a>
        </div>

        <!-- Search -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search authors..."
                           class="input-field">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <!-- Authors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($authors as $author)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center overflow-hidden mr-4">
                                @if($author->photo)
                                    <img src="{{ $author->photo }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $author->name }}</h3>
                                @if($author->nationality)
                                    <p class="text-gray-500 text-sm">{{ $author->nationality }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($author->biography)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($author->biography, 120) }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-blue-600 font-medium">
                                {{ $author->books_count }} {{ Str::plural('book', $author->books_count) }}
                            </span>
                            @if($author->birth_date)
                                <span class="text-gray-500 text-sm">
                                    Born {{ $author->birth_date->format('Y') }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.authors.show', $author) }}" 
                               class="flex-1 btn btn-outline text-sm py-2 text-center">
                                View
                            </a>
                            <a href="{{ route('admin.authors.edit', $author) }}" 
                               class="flex-1 btn btn-primary text-sm py-2 text-center">
                                Edit
                            </a>
                            @if($author->books_count === 0)
                                <button onclick="deleteAuthor({{ $author->id }})" 
                                        class="btn bg-red-600 text-white hover:bg-red-700 text-sm py-2 px-3">
                                    Delete
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">No authors found</h3>
                    <p class="text-gray-500 mb-4">Get started by adding your first author.</p>
                    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                        Add New Author
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($authors->hasPages())
            <div class="mt-8">
                {{ $authors->links() }}
            </div>
        @endif
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
                    setTimeout(() => location.reload(), 1000);
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

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
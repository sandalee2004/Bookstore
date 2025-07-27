@extends('layouts.app')

@section('title', $category->name . ' - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                <p class="text-gray-600">Category Details</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Category
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Categories
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Category Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    @if($category->image)
                        <img src="{{ $category->image }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-32 object-cover rounded-lg mb-4">
                    @endif
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $category->name }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                            <p class="text-gray-900 font-mono text-sm">{{ $category->slug }}</p>
                        </div>
                        
                        @if($category->description)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                            <p class="text-gray-900">{{ $category->description }}</p>
                        </div>
                        @endif
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Total Books</label>
                            <p class="text-2xl font-bold text-blue-600">{{ $category->books_count }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                            <p class="text-gray-900">{{ $category->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('books.index', ['category' => $category->slug]) }}" 
                           target="_blank"
                           class="btn btn-outline w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            View on Site
                        </a>
                        
                        <button onclick="toggleStatus({{ $category->id }})" 
                                class="btn {{ $category->is_active ? 'bg-yellow-600 text-white hover:bg-yellow-700' : 'bg-green-600 text-white hover:bg-green-700' }} w-full">
                            {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                        
                        @if($category->books_count === 0)
                            <button onclick="deleteCategory({{ $category->id }})" 
                                    class="btn bg-red-600 text-white hover:bg-red-700 w-full">
                                Delete Category
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Books in Category -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Books in this Category</h2>
                    
                    @if($category->books->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($category->books as $book)
                                <div class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg">
                                    <img src="{{ $book->cover_image }}" 
                                         alt="{{ $book->title }}" 
                                         class="w-12 h-16 object-cover rounded">
                                    
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-gray-900 truncate">{{ $book->title }}</h3>
                                        <p class="text-sm text-gray-600">by {{ $book->author->name }}</p>
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
                        
                        @if($category->books_count > 10)
                            <div class="text-center mt-6">
                                <a href="{{ route('admin.books.index', ['category' => $category->id]) }}" 
                                   class="btn btn-outline">
                                    View All Books ({{ $category->books_count }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">No books in this category</h3>
                            <p class="text-gray-500 mb-4">Add books to this category to see them here.</p>
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
    function toggleStatus(categoryId) {
        fetch(`/admin/categories/${categoryId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Category status updated successfully', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast('Error updating category status', 'error');
            }
        })
        .catch(error => {
            showToast('Error updating category status', 'error');
        });
    }

    function deleteCategory(categoryId) {
        if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
            fetch(`/admin/categories/${categoryId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Category deleted successfully', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.categories.index") }}';
                    }, 1000);
                } else {
                    showToast('Error deleting category', 'error');
                }
            })
            .catch(error => {
                showToast('Error deleting category', 'error');
            });
        }
    }
</script>
@endpush
@endsection
@extends('layouts.app')

@section('title', $book->title . ' - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                <p class="text-gray-600">Book Details</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Book
                </a>
                <a href="{{ route('admin.books.index') }}" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Books
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Book Image -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <img src="{{ $book->cover_image }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-auto object-cover rounded-lg shadow-lg">
                    
                    <!-- Status Badges -->
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Status:</span>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $book->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $book->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        @if($book->is_featured)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Featured:</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Yes
                                </span>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Stock:</span>
                            <span class="text-sm {{ $book->stock_quantity <= 5 ? 'text-red-600 font-medium' : 'text-gray-900' }}">
                                {{ $book->stock_quantity }} units
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Book Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-8">
                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Title</label>
                                <p class="text-gray-900">{{ $book->title }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Author</label>
                                <p class="text-gray-900">{{ $book->author->name ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                                <p class="text-gray-900">{{ $book->category->name ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">ISBN</label>
                                <p class="text-gray-900 font-mono">{{ $book->isbn }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Language</label>
                                <p class="text-gray-900">{{ $book->language }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Pages</label>
                                <p class="text-gray-900">{{ $book->pages ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Publisher</label>
                                <p class="text-gray-900">{{ $book->publisher ?? 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Publication Date</label>
                                <p class="text-gray-900">{{ $book->publication_date?->format('M d, Y') ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Description</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <!-- Pricing -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Pricing</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Regular Price</label>
                                <p class="text-2xl font-bold text-gray-900">${{ number_format($book->price, 2) }}</p>
                            </div>
                            
                            @if($book->discount_price)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Discount Price</label>
                                    <p class="text-2xl font-bold text-green-600">${{ number_format($book->discount_price, 2) }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Savings</label>
                                    <p class="text-lg font-medium text-red-600">
                                        ${{ number_format($book->price - $book->discount_price, 2) }}
                                        ({{ $book->discount_percentage }}% off)
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Statistics</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Rating</label>
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">{{ number_format($book->rating, 1) }}/5</span>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Reviews</label>
                                <p class="text-lg font-medium text-gray-900">{{ $book->reviews_count }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                                <p class="text-sm text-gray-900">{{ $book->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('books.show', $book->slug) }}" 
                               target="_blank"
                               class="btn btn-outline">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                View on Site
                            </a>
                            
                            <button onclick="toggleStatus({{ $book->id }})" 
                                    class="btn {{ $book->is_active ? 'bg-yellow-600 text-white hover:bg-yellow-700' : 'bg-green-600 text-white hover:bg-green-700' }}">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                </svg>
                                {{ $book->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                            
                            <button onclick="deleteBook({{ $book->id }})" 
                                    class="btn bg-red-600 text-white hover:bg-red-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleStatus(bookId) {
        fetch(`/admin/books/${bookId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Book status updated successfully', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast('Error updating book status', 'error');
            }
        })
        .catch(error => {
            showToast('Error updating book status', 'error');
        });
    }

    function deleteBook(bookId) {
        if (confirm('Are you sure you want to delete this book? This action cannot be undone.')) {
            fetch(`/admin/books/${bookId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Book deleted successfully', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.books.index") }}';
                    }, 1000);
                } else {
                    showToast('Error deleting book', 'error');
                }
            })
            .catch(error => {
                showToast('Error deleting book', 'error');
            });
        }
    }
</script>
@endpush
@endsection
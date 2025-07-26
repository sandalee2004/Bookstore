@extends('layouts.app')

@section('title', 'Manage Books - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Manage Books</h1>
                <p class="text-gray-600">Add, edit, and manage your book inventory</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Book
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search books..."
                           class="input-field">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="input-field">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="input-field">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <div class="flex items-end space-x-2">
                    <button type="submit" class="btn btn-primary flex-1">Filter</button>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
        </div>

        <!-- Books Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Book
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Author & Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-12">
                                            <img class="h-16 w-12 object-cover rounded" 
                                                 src="{{ $book->cover_image }}" 
                                                 alt="{{ $book->title }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 line-clamp-2">
                                                {{ $book->title }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                ISBN: {{ $book->isbn }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $book->author->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $book->category->name ?? 'N/A' }}</div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($book->discount_price)
                                            <span class="font-medium text-green-600">${{ number_format($book->discount_price, 2) }}</span>
                                            <div class="text-xs text-gray-500 line-through">${{ number_format($book->price, 2) }}</div>
                                        @else
                                            ${{ number_format($book->price, 2) }}
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm {{ $book->stock_quantity <= 5 ? 'text-red-600 font-medium' : 'text-gray-900' }}">
                                        {{ $book->stock_quantity }} in stock
                                    </div>
                                    @if($book->stock_quantity <= 5)
                                        <div class="text-xs text-red-500">Low Stock!</div>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $book->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $book->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        @if($book->is_featured)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Featured
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.books.show', $book) }}" 
                                           class="text-blue-600 hover:text-blue-900" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        
                                        <a href="{{ route('admin.books.edit', $book) }}" 
                                           class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        
                                        <button onclick="toggleStatus({{ $book->id }})" 
                                                class="text-yellow-600 hover:text-yellow-900" 
                                                title="{{ $book->is_active ? 'Deactivate' : 'Activate' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                            </svg>
                                        </button>
                                        
                                        <button onclick="deleteBook({{ $book->id }})" 
                                                class="text-red-600 hover:text-red-900" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-700 mb-2">No books found</h3>
                                    <p class="text-gray-500 mb-4">Get started by adding your first book.</p>
                                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                                        Add New Book
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($books->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $books->links() }}
                </div>
            @endif
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
                    setTimeout(() => location.reload(), 1000);
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

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
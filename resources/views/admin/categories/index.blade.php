@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Manage Categories</h1>
                <p class="text-gray-600">Organize your books by categories</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Category
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search categories..."
                           class="input-field">
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
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        @if($category->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $category->description }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-blue-600 font-medium">
                                {{ $category->books_count }} {{ Str::plural('book', $category->books_count) }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                Created {{ $category->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.categories.show', $category) }}" 
                               class="flex-1 btn btn-outline text-sm py-2 text-center">
                                View
                            </a>
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="flex-1 btn btn-primary text-sm py-2 text-center">
                                Edit
                            </a>
                            <button onclick="toggleStatus({{ $category->id }})" 
                                    class="btn {{ $category->is_active ? 'bg-yellow-600 text-white hover:bg-yellow-700' : 'bg-green-600 text-white hover:bg-green-700' }} text-sm py-2 px-3">
                                {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">No categories found</h3>
                    <p class="text-gray-500 mb-4">Get started by creating your first category.</p>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        Add New Category
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="mt-8">
                {{ $categories->links() }}
            </div>
        @endif
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
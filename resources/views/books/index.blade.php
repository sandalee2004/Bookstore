@extends('layouts.app')

@section('title', 'All Books - BookStore')
@section('description', 'Browse our extensive collection of books across all genres.')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">All Books</h1>
                    <p class="text-gray-600">Discover your next favorite book from our collection</p>
                </div>
                
                <!-- Mobile Filter Toggle -->
                <div class="mt-4 md:mt-0">
                    <button id="mobile-filter-toggle" 
                            class="md:hidden btn btn-outline flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                        </svg>
                        Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div id="filters-sidebar" class="w-full lg:w-80 space-y-6 hidden lg:block">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">Filters</h3>
                    
                    <form method="GET" id="filter-form" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Search Books</label>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Title, author, ISBN..." 
                                   class="input-field">
                        </div>

                        <!-- Categories -->
                        @if(isset($categories) && $categories->count() > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="category" class="input-field">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" 
                                            {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Authors -->
                        @if(isset($authors) && $authors->count() > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                            <select name="author" class="input-field">
                                <option value="">All Authors</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->slug }}" 
                                            {{ request('author') == $author->slug ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Price Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" 
                                       name="min_price" 
                                       value="{{ request('min_price') }}"
                                       placeholder="Min $" 
                                       min="0" 
                                       step="0.01"
                                       class="input-field">
                                <input type="number" 
                                       name="max_price" 
                                       value="{{ request('max_price') }}"
                                       placeholder="Max $" 
                                       min="0" 
                                       step="0.01"
                                       class="input-field">
                            </div>
                        </div>

                        <!-- Quick Filters -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quick Filters</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="featured" value="1" 
                                           {{ request('featured') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="ml-2 text-sm text-gray-600">Featured Books</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="on_sale" value="1" 
                                           {{ request('on_sale') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="ml-2 text-sm text-gray-600">On Sale</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="in_stock" value="1" 
                                           {{ request('in_stock') ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="ml-2 text-sm text-gray-600">In Stock Only</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex space-x-2">
                            <button type="submit" class="btn btn-primary flex-1">Apply Filters</button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Clear</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Sort and View Options -->
                <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                            <span class="text-sm text-gray-600">
                                @if(isset($books))
                                    Showing {{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }} 
                                    of {{ $books->total() }} books
                                @else
                                    Loading books...
                                @endif
                            </span>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Sort Options -->
                            <select name="sort" onchange="applySort(this.value)" class="text-sm border-gray-300 rounded-lg">
                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price Low-High</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            </select>

                            <!-- View Toggle -->
                            <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                                <button id="grid-view" class="p-2 bg-primary-50 text-primary-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                </button>
                                <button id="list-view" class="p-2 bg-gray-50 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Books Grid -->
                <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @if(isset($books) && $books->count() > 0)
                        @foreach($books as $book)
                            <div class="book-card bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 group overflow-hidden animate-fade-in-up" 
                                 style="animation-delay: {{ $loop->index * 0.05 }}s;">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $book->cover_image }}" 
                                         alt="{{ $book->title }}" 
                                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy">
                                    
                                    <!-- Overlay actions -->
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 space-x-2">
                                            <button onclick="quickView({{ $book->id }})" 
                                                    class="btn btn-primary btn-sm">
                                                Quick View
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Badges -->
                                    @if($book->discount_percentage > 0)
                                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                            -{{ $book->discount_percentage }}%
                                        </div>
                                    @endif

                                    @if($book->is_featured)
                                        <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                            ⭐ Featured
                                        </div>
                                    @endif

                                    @if(!$book->is_in_stock)
                                        <div class="absolute inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                            <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                Out of Stock
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-1 group-hover:text-primary-600 transition-colors line-clamp-2">
                                        <a href="{{ route('books.show', $book->slug) }}">{{ $book->title }}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-2">by {{ $book->author->name ?? 'Unknown Author' }}</p>
                                    <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ Str::limit($book->description ?? '', 100) }}</p>
                                    
                                    <!-- Rating -->
                                    <div class="flex items-center mb-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= ($book->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}" 
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                        <span class="text-xs text-gray-500 ml-1">({{ $book->reviews_count ?? 0 }})</span>
                                    </div>

                                    <!-- Price -->
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            @if($book->discount_price)
                                                <span class="text-lg font-bold text-primary-600">${{ number_format($book->discount_price, 2) }}</span>
                                                <span class="text-sm text-gray-500 line-through">${{ number_format($book->price, 2) }}</span>
                                            @else
                                                <span class="text-lg font-bold text-primary-600">${{ number_format($book->price ?? 0, 2) }}</span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $book->category->name ?? 'Uncategorized' }}</span>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('books.show', $book->slug) }}" 
                                           class="flex-1 btn btn-outline text-sm py-2 text-center">
                                            View Details
                                        </a>
                                        @if($book->is_in_stock ?? true)
                                            <button onclick="addToCart({{ $book->id }})" 
                                                    class="flex-1 btn btn-primary text-sm py-2 flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12"/>
                                                </svg>
                                                Add to Cart
                                            </button>
                                        @else
                                            <button disabled class="flex-1 btn bg-gray-300 text-gray-500 text-sm py-2 cursor-not-allowed">
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">No books found</h3>
                            <p class="text-gray-500 mb-4">Try adjusting your filters or search terms</p>
                            <a href="{{ route('books.index') }}" class="btn btn-primary">Clear Filters</a>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if(isset($books) && $books->hasPages())
                    <div class="mt-8">
                        {{ $books->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick View Modal -->
<div id="quick-view-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50" onclick="closeQuickView()"></div>
        <div class="relative bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div id="quick-view-content" class="p-6">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Mobile filter toggle
    document.getElementById('mobile-filter-toggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('filters-sidebar');
        sidebar.classList.toggle('hidden');
    });

    // Sort functionality
    function applySort(sortValue) {
        const url = new URL(window.location);
        url.searchParams.set('sort', sortValue);
        window.location.href = url.toString();
    }

    // View toggle functionality (placeholder - you can enhance this)
    const gridView = document.getElementById('grid-view');
    const listView = document.getElementById('list-view');
    const booksContainer = document.getElementById('books-container');

    gridView?.addEventListener('click', function() {
        booksContainer.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6';
        gridView.className = 'p-2 bg-primary-50 text-primary-600';
        listView.className = 'p-2 bg-gray-50 text-gray-400';
    });

    listView?.addEventListener('click', function() {
        booksContainer.className = 'space-y-6';
        listView.className = 'p-2 bg-primary-50 text-primary-600';
        gridView.className = 'p-2 bg-gray-50 text-gray-400';
    });

    // Quick view functionality (placeholder)
    function quickView(bookId) {
        // You can implement this later with AJAX
        showToast('Quick view feature coming soon!', 'info');
    }

    function closeQuickView() {
        document.getElementById('quick-view-modal').classList.add('hidden');
    }

    // Add to cart functionality
    function addToCart(bookId) {
        @auth
            fetch(`/cart/add/${bookId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: 1 })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Book added to cart successfully!', 'success');
                    updateCartCount();
                } else {
                    showToast(data.message || 'Error adding book to cart', 'error');
                }
            })
            .catch(error => {
                showToast('Error adding book to cart', 'error');
            });
        @else
            showToast('Please login to add books to cart', 'error');
            setTimeout(() => {
                window.location.href = '{{ route("login") }}';
            }, 2000);
        @endauth
    }

    // Update cart count
    function updateCartCount() {
        @auth
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    // Update cart badge if it exists
                    const cartBadges = document.querySelectorAll('.cart-count');
                    cartBadges.forEach(badge => {
                        badge.textContent = data.count;
                        if (data.count > 0) {
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    });
                });
        @endauth
    }

    // Filter form submission
    document.getElementById('filter-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const url = new URL(window.location.pathname, window.location.origin);
        
        // Add form data to URL parameters
        for (const [key, value] of formData.entries()) {
            if (value) {
                url.searchParams.set(key, value);
            }
        }
        
        window.location.href = url.toString();
    });

    // Auto-submit on select changes
    document.querySelectorAll('#filter-form select, #filter-form input[type="checkbox"]').forEach(element => {
        element.addEventListener('change', function() {
            document.getElementById('filter-form').dispatchEvent(new Event('submit'));
        });
    });
</script>
@endpush

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
</style>
@endsection"

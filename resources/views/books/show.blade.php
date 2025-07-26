@extends('layouts.app')

@section('title', $book->title . ' - BookStore')
@section('description', Str::limit($book->description, 160))

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                </li>
                <li>
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('books.index') }}" class="text-gray-500 hover:text-gray-700">Books</a>
                </li>
                <li>
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </li>
                <li class="text-gray-900 font-medium">{{ Str::limit($book->title, 50) }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Book Image -->
            <div class="animate-fade-in-up">
                <div class="sticky top-8">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-100">
                            <img src="{{ $book->cover_image }}" 
                                 alt="{{ $book->title }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        @if($book->is_featured)
                            <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                ⭐ Featured
                            </div>
                        @endif
                        
                        @if($book->discount_percentage > 0)
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                -{{ $book->discount_percentage }}% OFF
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Book Details -->
            <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <!-- Title and Author -->
                    <div class="mb-6">
                        <h1 class="text-4xl font-bold text-gray-900 mb-3">{{ $book->title }}</h1>
                        <p class="text-xl text-gray-600 mb-2">
                            by <a href="{{ route('authors.show', $book->author->slug) }}" 
                                  class="text-primary-600 hover:text-primary-700 font-medium">{{ $book->author->name }}</a>
                        </p>
                        <p class="text-gray-500">
                            Category: <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" 
                                        class="text-primary-600 hover:text-primary-700">{{ $book->category->name }}</a>
                        </p>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center mb-6">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="ml-3 text-lg text-gray-600">{{ number_format($book->rating, 1) }}/5</span>
                        <span class="ml-2 text-gray-500">({{ $book->reviews_count }} reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-4 mb-2">
                            @if($book->discount_price)
                                <span class="text-4xl font-bold text-primary-600">${{ number_format($book->discount_price, 2) }}</span>
                                <span class="text-2xl text-gray-500 line-through">${{ number_format($book->price, 2) }}</span>
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Save ${{ number_format($book->price - $book->discount_price, 2) }}
                                </span>
                            @else
                                <span class="text-4xl font-bold text-primary-600">${{ number_format($book->price, 2) }}</span>
                            @endif
                        </div>
                        
                        <!-- Stock Status -->
                        @if($book->is_in_stock)
                            <div class="flex items-center text-green-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">In Stock ({{ $book->stock_quantity }} available)</span>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Out of Stock</span>
                            </div>
                        @endif
                    </div>

                    <!-- Add to Cart -->
                    <div class="mb-8">
                        @if($book->is_in_stock)
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex items-center">
                                    <label for="quantity" class="text-sm font-medium text-gray-700 mr-3">Quantity:</label>
                                    <select id="quantity" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary-500 focus:border-primary-500">
                                        @for($i = 1; $i <= min(10, $book->stock_quantity); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="flex space-x-4">
                                <button onclick="addToCart({{ $book->id }})" 
                                        class="flex-1 btn btn-primary text-lg py-3 flex items-center justify-center transform hover:scale-105 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12"/>
                                    </svg>
                                    Add to Cart
                                </button>
                                <button class="btn btn-outline py-3 px-6 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>
                        @else
                            <button disabled class="w-full btn bg-gray-300 text-gray-500 py-3 cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    </div>

                    <!-- Book Details -->
                    <div class="border-t pt-6">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-700">ISBN:</span>
                                <span class="text-gray-600">{{ $book->isbn }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Pages:</span>
                                <span class="text-gray-600">{{ $book->pages ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Language:</span>
                                <span class="text-gray-600">{{ $book->language }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Publisher:</span>
                                <span class="text-gray-600">{{ $book->publisher ?? 'N/A' }}</span>
                            </div>
                            @if($book->publication_date)
                            <div>
                                <span class="font-medium text-gray-700">Published:</span>
                                <span class="text-gray-600">{{ $book->publication_date->format('M d, Y') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mt-12 bg-white rounded-2xl shadow-xl p-8 animate-fade-in-up" style="animation-delay: 0.4s;">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Book</h2>
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {{ $book->description }}
            </div>
        </div>

        <!-- Related Books -->
        @if(isset($relatedBooks) && $relatedBooks->count() > 0)
        <div class="mt-12 animate-fade-in-up" style="animation-delay: 0.6s;">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">You Might Also Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedBooks as $relatedBook)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 group overflow-hidden">
                        <div class="relative overflow-hidden">
                            <img src="{{ $relatedBook->cover_image }}" 
                                 alt="{{ $relatedBook->title }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">
                                <a href="{{ route('books.show', $relatedBook->slug) }}">{{ $relatedBook->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-2">by {{ $relatedBook->author->name }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600">
                                    ${{ number_format($relatedBook->final_price, 2) }}
                                </span>
                                <button onclick="addToCart({{ $relatedBook->id }})" 
                                        class="btn btn-primary btn-sm">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function addToCart(bookId) {
        const quantity = document.getElementById('quantity')?.value || 1;
        
        @auth
            fetch(`/cart/add/${bookId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: parseInt(quantity) })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(`${quantity} book(s) added to cart successfully!`, 'success');
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

    function updateCartCount() {
        @auth
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
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
</script>
@endpush

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .aspect-w-3 {
        position: relative;
        padding-bottom: 133.33%;
    }
    
    .aspect-w-3 > * {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
@endsection
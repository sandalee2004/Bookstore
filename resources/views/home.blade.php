@extends('layouts.app')

@section('title', 'BookStore - Your Online Library')
@section('description', 'Discover thousands of books online. Buy your favorite books with fast delivery and secure payment.')

@section('content')
<div class="overflow-hidden relative">
    <!-- Animated Background Particles -->
    <div class="particles-bg"></div>
    
    <!-- Hero Section -->
    <section class="relative hero-gradient min-h-screen flex items-center">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-element absolute top-20 left-20 w-20 h-20 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full opacity-30 blur-sm"></div>
            <div class="floating-element absolute top-40 right-32 w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full opacity-40 blur-sm" style="animation-delay: 2s;"></div>
            <div class="floating-element absolute bottom-40 left-1/4 w-12 h-12 bg-gradient-to-br from-pink-400 to-red-500 rounded-full opacity-35 blur-sm" style="animation-delay: 4s;"></div>
            <div class="floating-element absolute top-1/3 right-20 w-24 h-24 bg-gradient-to-br from-green-400 to-blue-500 rounded-full opacity-25 blur-sm" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="scroll-reveal">
                    <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                        <span class="gradient-text text-reveal">Discover</span><br>
                        <span class="text-white drop-shadow-lg">Your Next</span><br>
                        <span class="gradient-text text-reveal">Great Read</span>
                    </h1>
                    <p class="text-xl text-white/90 mb-8 leading-relaxed drop-shadow-md">
                        Explore thousands of books across all genres. From bestselling novels to academic texts, 
                        find your perfect book with fast delivery and secure payment.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="{{ route('books.index') }}" class="btn btn-primary text-lg px-8 py-4 inline-flex items-center justify-center group magnetic ripple">
                            Browse Books
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="#featured" class="btn btn-outline text-lg px-8 py-4 inline-flex items-center justify-center magnetic ripple">
                            Featured Books
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
                        <div class="text-center transform hover:scale-110 transition-transform duration-300 tilt-3d">
                            <div class="text-3xl font-bold text-white mb-1 drop-shadow-lg">
                                @php
                                    echo number_format(\App\Models\Book::count()) . '+';
                                @endphp
                            </div>
                            <div class="text-sm text-white/80">Books Available</div>
                        </div>
                        <div class="text-center transform hover:scale-110 transition-transform duration-300 tilt-3d">
                            <div class="text-3xl font-bold text-white mb-1 drop-shadow-lg">
                                @php
                                    echo number_format(\App\Models\User::count() * 50) . '+';
                                @endphp
                            </div>
                            <div class="text-sm text-white/80">Happy Customers</div>
                        </div>
                        <div class="text-center transform hover:scale-110 transition-transform duration-300 tilt-3d">
                            <div class="text-3xl font-bold text-white mb-1 drop-shadow-lg">24/7</div>
                            <div class="text-sm text-white/80">Customer Support</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image - 3D Book Stack -->
                <div class="relative scroll-reveal" style="animation-delay: 0.3s;">
                    <div class="relative">
                        <!-- Main book stack -->
                        <div class="relative z-10 transform rotate-3 hover:rotate-0 transition-transform duration-500 tilt-3d">
                            <div class="book-spine bg-gradient-to-br from-blue-500 to-blue-700 w-48 h-64 shadow-2xl mx-auto relative overflow-hidden morph-hover">
                                <div class="absolute inset-4 bg-white/10 rounded border border-white/20"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="text-white font-bold text-lg">The Great</div>
                                    <div class="text-white font-bold text-lg">Adventure</div>
                                    <div class="text-white/80 text-sm mt-2">Classic Novel</div>
                                </div>
                            </div>
                        </div>

                        <!-- Second book -->
                        <div class="absolute top-4 left-8 transform -rotate-6 hover:rotate-0 transition-transform duration-500 tilt-3d">
                            <div class="book-spine bg-gradient-to-br from-purple-500 to-purple-700 w-44 h-60 shadow-xl relative overflow-hidden morph-hover">
                                <div class="absolute inset-4 bg-white/10 rounded border border-white/20"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="text-white font-bold text-lg">Mystery</div>
                                    <div class="text-white font-bold text-lg">Tales</div>
                                    <div class="text-white/80 text-sm mt-2">Thriller</div>
                                </div>
                            </div>
                        </div>

                        <!-- Third book -->
                        <div class="absolute top-8 right-4 transform rotate-12 hover:rotate-6 transition-transform duration-500 tilt-3d">
                            <div class="book-spine bg-gradient-to-br from-green-500 to-green-700 w-40 h-56 shadow-lg relative overflow-hidden morph-hover">
                                <div class="absolute inset-4 bg-white/10 rounded border border-white/20"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="text-white font-bold text-base">Science</div>
                                    <div class="text-white font-bold text-base">Fiction</div>
                                    <div class="text-white/80 text-sm mt-2">Sci-Fi</div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating elements -->
                        <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full floating-element shadow-lg"></div>
                        <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-gradient-to-br from-pink-400 to-red-500 rounded-full floating-element shadow-lg" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Featured Books Section -->
    <section id="featured" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Books</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover our hand-picked selection of the most popular and critically acclaimed books
                </p>
            </div>

            @if(isset($featuredBooks) && $featuredBooks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 scroll-reveal">
                    @foreach($featuredBooks as $book)
                    <div class="card card-hover group stagger-animation tilt-3d magnetic" 
                         data-book-id="{{ $book->id }}">
                        <div class="relative overflow-hidden image-hover-effect">
                            <img src="{{ $book->cover_image }}" 
                                 alt="{{ $book->title }}" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
                                 loading="lazy">
                            
                            @if($book->discount_percentage > 0)
                                <div class="absolute top-2 right-2 modern-badge">
                                    -{{ $book->discount_percentage }}%
                                </div>
                            @endif

                            @if($book->is_featured)
                                <div class="absolute top-2 left-2 modern-badge bg-gradient-to-r from-yellow-400 to-orange-500">
                                    ⭐ Featured
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                {{ $book->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-2">by {{ $book->author->name }}</p>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-3">{{ $book->description }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    @if($book->discount_price)
                                        <span class="text-lg font-bold text-blue-600">${{ number_format($book->discount_price, 2) }}</span>
                                        <span class="text-sm text-gray-500 line-through">${{ number_format($book->price, 2) }}</span>
                                    @else
                                        <span class="text-lg font-bold text-blue-600">${{ number_format($book->price, 2) }}</span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $book->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                    <span class="text-xs text-gray-500 ml-1">({{ $book->reviews_count }})</span>
                                </div>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('books.show', $book->slug) }}" class="flex-1 btn btn-outline text-sm py-2 text-center ripple">
                                    View Details
                                </a>
                                <button onclick="addToCart({{ $book->id }})" class="flex-1 btn btn-primary text-sm py-2 flex items-center justify-center magnetic ripple">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12"/>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No featured books yet</h3>
                    <p class="text-gray-500 mb-4">Check out our full catalog</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Browse All Books</a>
                </div>
            @endif

            <div class="text-center mt-12 scroll-reveal">
                <a href="{{ route('books.index') }}" class="btn btn-primary text-lg px-8 py-3 magnetic ripple">
                    View All Books
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Browse by Category</h2>
                <p class="text-xl text-gray-600">
                    Find books in your favorite genres
                </p>
            </div>

            @if(isset($categories) && $categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 scroll-reveal">
                    @foreach($categories as $category)
                    <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="group block stagger-animation magnetic">
                        <div class="card p-6 text-center group-hover:bg-blue-50 tilt-3d morph-hover">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-100 to-purple-200 rounded-full flex items-center justify-center group-hover:from-blue-200 group-hover:to-purple-300 transition-all duration-300 floating-element">
                                @if($category->image)
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-8 h-8">
                                @else
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $category->books_count }} books
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose BookStore?</h2>
                <p class="text-xl text-gray-600">
                    Experience the best online book shopping with our premium features
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 scroll-reveal">
                <div class="text-center stagger-animation tilt-3d magnetic">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center floating-element shadow-lg">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Fast Delivery</h3>
                    <p class="text-gray-600">Get your books delivered within 2-3 business days with our express shipping service.</p>
                </div>

                <div class="text-center stagger-animation tilt-3d magnetic">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center floating-element shadow-lg" style="animation-delay: 1s;">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Secure Payment</h3>
                    <p class="text-gray-600">Your payment information is protected with bank-level security and encryption.</p>
                </div>

                <div class="text-center stagger-animation tilt-3d magnetic">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center floating-element shadow-lg" style="animation-delay: 2s;">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Customer Love</h3>
                    <p class="text-gray-600">Join thousands of satisfied customers who trust us for their reading needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="scroll-reveal relative z-10">
                <h2 class="text-4xl font-bold text-white mb-4">Stay Updated</h2>
                <p class="text-xl text-white/90 mb-8">
                    Get the latest book recommendations, exclusive deals, and literary news delivered to your inbox
                </p>
                
                <form class="max-w-md mx-auto flex gap-4" onsubmit="subscribeNewsletter(event)">
                    <input type="email" placeholder="Enter your email address" required
                           class="flex-1 px-6 py-3 rounded-xl border-0 text-gray-900 placeholder-gray-500 focus:ring-4 focus:ring-white/50 glass-effect">
                    <button type="submit" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-xl hover:bg-gray-100 transition-all duration-300 magnetic ripple shadow-lg">
                        Subscribe
                    </button>
                </form>
                
                <p class="text-white/70 text-sm mt-4">
                    No spam, unsubscribe at any time. We respect your privacy.
                </p>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    // Add to cart functionality
    function addToCart(bookId, element) {
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
                    showToast('Book added to cart with style! ✨', 'success');
                    
                    // Add visual feedback
                    if (element) {
                        element.style.animation = 'pulse3D 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                    }
                    updateCartCount();
                } else {
                    showToast(data.message || 'Error adding book to cart', 'error');
                }
            })
            .catch(error => {
                showToast('Oops! Something went wrong 😅', 'error');
            });
        @else
            showToast('Please login to add books to cart', 'error');
            setTimeout(() => {
                window.location.href = '{{ route("login") }}';
            }, 2000);
        @endauth
    }

    // Newsletter subscription
    function subscribeNewsletter(event) {
        event.preventDefault();
        const form = event.target;
        
        // Simulate subscription (you can implement actual newsletter functionality)
        showToast('🎉 Welcome to our book-loving community!', 'success');
        form.reset();
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
</script>
@endpush

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
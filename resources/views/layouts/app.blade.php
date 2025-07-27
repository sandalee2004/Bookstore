<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BookStore - Your Online Library')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Discover thousands of books online. Buy your favorite books with fast delivery and secure payment.')">
    <meta name="keywords" content="books, online bookstore, buy books, literature, novels, textbooks">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Additional head content -->
    @stack('head')
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ cartOpen: false, mobileMenuOpen: false }">
    <!-- Navigation -->
    <nav class="navbar-blur sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group magnetic">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-500 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold gradient-text">BookStore</span>
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <div class="relative w-full">
                        <input type="text" placeholder="Search for books, authors..." 
                               class="w-full pl-10 pr-4 py-2 glass-effect rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('books.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 magnetic">Books</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 magnetic">Categories</a>
                    <a href="{{ route('authors.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 magnetic">Authors</a>
                </div>

                <!-- User Menu & Cart -->
                <div class="flex items-center space-x-4">
                    <!-- Cart Icon -->
                    <button @click="cartOpen = true" class="relative p-2 text-gray-700 hover:text-blue-600 transition-colors duration-200 magnetic cart-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12M7 13v6a1 1 0 001 1h8a1 1 0 001-1v-6M7 13l-2.4-8M15 17a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @auth
                            @if(auth()->user()->cart_items_count > 0)
                                <span class="absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center modern-badge">
                                    {{ auth()->user()->cart_items_count }}
                                </span>
                            @endif
                        @endauth
                    </button>

                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium magnetic">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary ripple">Sign Up</a>
                    @else
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 magnetic">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                            </button>
                            
                            <div x-show="userMenuOpen" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @click.away="userMenuOpen = false"
                                 class="absolute right-0 mt-2 w-48 glass-effect rounded-xl shadow-2xl py-2 z-50 border border-white/20">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Panel</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-md text-gray-700 hover:text-blue-600 magnetic">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="md:hidden border-t border-white/20 glass-effect">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('books.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50">Books</a>
                    <a href="{{ route('categories.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50">Categories</a>
                    <a href="{{ route('authors.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50">Authors</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen page-transition">
        @yield('content')
    </main>

    <!-- Cart Sidebar -->
    <div x-show="cartOpen" 
         x-transition:enter="transition ease-in-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in-out duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50" @click="cartOpen = false"></div>
        
        <div x-show="cartOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="absolute right-0 top-0 h-full w-full max-w-md glass-effect shadow-2xl">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between p-4 border-b border-white/20">
                    <h2 class="text-lg font-semibold">Shopping Cart</h2>
                    <button @click="cartOpen = false" class="p-2 hover:bg-gray-100 rounded-full magnetic">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <div class="flex-1 overflow-y-auto p-4">
                    @auth
                        <div id="cart-items-container">
                            @php
                                $cartItems = auth()->user()->cartItems()->with('book.author')->get();
                            @endphp
                            @if($cartItems->count() > 0)
                                <div class="space-y-3">
                                    @foreach($cartItems as $item)
                                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                            <img src="{{ $item->book->cover_image }}" 
                                                 alt="{{ $item->book->title }}" 
                                                 class="w-12 h-16 object-cover rounded">
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-medium text-gray-900 text-sm truncate">{{ $item->book->title }}</h4>
                                                <p class="text-xs text-gray-600">by {{ $item->book->author->name }}</p>
                                                <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-medium text-gray-900">${{ number_format($item->book->final_price * $item->quantity, 2) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12M7 13v6a1 1 0 001 1h8a1 1 0 001-1v-6M7 13l-2.4-8"/>
                                    </svg>
                                    <p class="text-gray-500">Your cart is empty</p>
                                    <a href="{{ route('books.index') }}" class="btn btn-primary mt-4 ripple">Browse Books</a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Please login to view your cart</p>
                            <a href="{{ route('login') }}" class="btn btn-primary ripple">Login</a>
                        </div>
                    @endauth
                </div>
                
                @auth
                    @php
                        $cartItems = auth()->user()->cartItems()->with('book')->get();
                        $cartTotal = $cartItems->sum(function ($item) {
                            return $item->book->final_price * $item->quantity;
                        });
                    @endphp
                    @if($cartItems->count() > 0)
                        <div class="border-t border-white/20 p-4">
                            <div class="flex justify-between items-center mb-4">
                                <span class="font-semibold">Total: ${{ number_format($cartTotal, 2) }}</span>
                            </div>
                            <div class="space-y-2">
                                <a href="{{ route('cart.index') }}" class="btn btn-outline w-full ripple">View Cart</a>
                                <a href="{{ route('checkout.index') }}" class="btn btn-primary w-full ripple">Checkout</a>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 scroll-reveal">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">BookStore</span>
                    </div>
                    <p class="text-gray-300 mb-4">Your trusted online bookstore with thousands of books across all genres. Fast delivery, secure payment, and excellent customer service.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors magnetic">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors magnetic">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors magnetic">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z."/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('books.index') }}" class="text-gray-300 hover:text-white transition-colors magnetic">All Books</a></li>
                        <li><a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-white transition-colors magnetic">Categories</a></li>
                        <li><a href="{{ route('authors.index') }}" class="text-gray-300 hover:text-white transition-colors magnetic">Authors</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors magnetic">New Releases</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors magnetic">Bestsellers</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Customer Service</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors magnetic">Contact Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors magnetic">Shipping Info</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors magnetic">Returns</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="text-gray-300 hover:text-white transition-colors magnetic">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-300 hover:text-white transition-colors magnetic">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center scroll-reveal">
                <p class="text-gray-400">&copy; {{ date('Y') }} BookStore. All rights reserved. Built with ❤️ for book lovers.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none"></div>

    <script>
        // Flash messages
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast('{{ session('success') }}', 'success');
            });
        @endif
        
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast('{{ session('error') }}', 'error');
            });
        @endif
    </script>
</body>
</html>
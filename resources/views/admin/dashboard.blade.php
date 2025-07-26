@extends('layouts.app')

@section('title', 'Admin Dashboard - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
            <p class="text-gray-600">Manage your bookstore</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Books</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_books'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Users</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Orders</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_orders'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Revenue</p>
                        <p class="text-2xl font-semibold text-gray-900">${{ number_format($stats['revenue'] ?? 0, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('admin.books.create') }}" 
               class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow group">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Add New Book</h3>
                </div>
            </a>

            <a href="{{ route('admin.books.index') }}" 
               class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow group">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-green-200 transition-colors">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Manage Books</h3>
                </div>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow group">
                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-200 transition-colors">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">View Orders</h3>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow group">
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-200 transition-colors">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-yellow-600 transition-colors">Manage Users</h3>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        View All
                    </a>
                </div>
                
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentOrders as $order)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-semibold text-gray-900">{{ $order->order_number }}</h3>
                                        <p class="text-sm text-gray-600">{{ $order->user->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-semibold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                               ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                                               'bg-gray-100 text-gray-800')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No recent orders</p>
                @endif
            </div>

            <!-- Top Books -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Top Books</h2>
                    <a href="{{ route('admin.books.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        View All
                    </a>
                </div>
                
                @if(isset($topBooks) && $topBooks->count() > 0)
                    <div class="space-y-4">
                        @foreach($topBooks as $book)
                            <div class="flex items-center space-x-3">
                                <img src="{{ $book->cover_image }}" 
                                     alt="{{ $book->title }}" 
                                     class="w-12 h-12 object-cover rounded">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 line-clamp-1">{{ $book->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $book->author->name ?? 'Unknown Author' }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-900">{{ $book->reviews_count }} reviews</div>
                                    <div class="text-sm text-gray-500">${{ number_format($book->price, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No books available</p>
                @endif
            </div>
        </div>

        <!-- Alerts -->
        @if(isset($stats['pending_orders']) && $stats['pending_orders'] > 0)
            <div class="mt-8">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-yellow-800 font-medium">
                            You have {{ $stats['pending_orders'] }} pending orders that need attention.
                        </span>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
                           class="ml-4 text-yellow-800 hover:text-yellow-900 font-medium underline">
                            View Orders
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($stats['low_stock_books']) && $stats['low_stock_books'] > 0)
            <div class="mt-4">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-red-800 font-medium">
                            {{ $stats['low_stock_books'] }} books are running low on stock (≤5 items).
                        </span>
                        <a href="{{ route('admin.books.index', ['low_stock' => '1']) }}" 
                           class="ml-4 text-red-800 hover:text-red-900 font-medium underline">
                            View Books
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
@extends('layouts.app')

@section('title', 'Categories - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Book Categories</h1>
            <p class="text-xl text-gray-600">Explore books by your favorite genres</p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('books.index', ['category' => $category->slug]) }}" 
                   class="group block transform hover:scale-105 transition-all duration-300">
                    <div class="bg-white rounded-xl shadow-md p-8 text-center group-hover:shadow-xl group-hover:bg-blue-50 transition-all duration-300">
                        <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300">
                            @if($category->image)
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-10 h-10">
                            @else
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors mb-2">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-500 text-sm mb-3">{{ $category->description ?? 'Explore books in this category' }}</p>
                        <div class="text-blue-600 font-medium">
                            {{ $category->books_count }} {{ Str::plural('book', $category->books_count) }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($categories->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No categories found</h3>
                <p class="text-gray-500">Categories will appear here once they are added.</p>
            </div>
        @endif
    </div>
</div>
@endsection
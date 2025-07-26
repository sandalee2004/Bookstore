@extends('layouts.app')

@section('title', 'Authors - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Authors</h1>
            <p class="text-xl text-gray-600">Discover books from your favorite authors</p>
        </div>

        <!-- Authors Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($authors as $author)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center overflow-hidden">
                            @if($author->photo)
                                <img src="{{ $author->photo }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            @endif
                        </div>
                        
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $author->name }}</h3>
                        
                        @if($author->nationality)
                            <p class="text-gray-500 text-sm mb-2">{{ $author->nationality }}</p>
                        @endif
                        
                        <div class="text-blue-600 font-medium mb-4">
                            {{ $author->books_count }} {{ Str::plural('book', $author->books_count) }}
                        </div>
                        
                        @if($author->biography)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($author->biography, 120) }}</p>
                        @endif
                        
                        <a href="{{ route('books.index', ['author' => $author->slug]) }}" 
                           class="btn btn-outline w-full text-sm">
                            View Books
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($authors->hasPages())
            <div class="mt-8">
                {{ $authors->links() }}
            </div>
        @endif

        @if($authors->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No authors found</h3>
                <p class="text-gray-500">Authors will appear here once they are added.</p>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
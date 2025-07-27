@extends('layouts.app')

@section('title', 'Edit Author - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Author</h1>
                <p class="text-gray-600">Update author information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.authors.show', $author) }}" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View Author
                </a>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Authors
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.authors.update', $author) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Author Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $author->name) }}" 
                           required
                           class="input-field @error('name') border-red-500 @enderror"
                           placeholder="Enter author's full name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Biography -->
                <div>
                    <label for="biography" class="block text-sm font-medium text-gray-700 mb-2">Biography</label>
                    <textarea id="biography" 
                              name="biography" 
                              rows="6"
                              class="input-field @error('biography') border-red-500 @enderror"
                              placeholder="Enter author's biography">{{ old('biography', $author->biography) }}</textarea>
                    @error('biography')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo URL</label>
                    <input type="url" 
                           id="photo" 
                           name="photo" 
                           value="{{ old('photo', $author->photo) }}"
                           class="input-field @error('photo') border-red-500 @enderror"
                           placeholder="https://example.com/author-photo.jpg">
                    @error('photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Optional: Enter a URL for the author's photo</p>
                    
                    @if($author->photo)
                        <div class="mt-2">
                            <img src="{{ $author->photo }}" alt="{{ $author->name }}" class="w-20 h-20 object-cover rounded-lg">
                        </div>
                    @endif
                </div>

                <!-- Birth Date and Nationality -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Birth Date</label>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               value="{{ old('birth_date', $author->birth_date?->format('Y-m-d')) }}"
                               class="input-field @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">Nationality</label>
                        <input type="text" 
                               id="nationality" 
                               name="nationality" 
                               value="{{ old('nationality', $author->nationality) }}"
                               class="input-field @error('nationality') border-red-500 @enderror"
                               placeholder="e.g., American, British, Canadian">
                        @error('nationality')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Author
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Add New Author - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Author</h1>
                <p class="text-gray-600">Create a new author profile</p>
            </div>
            <a href="{{ route('admin.authors.index') }}" class="btn btn-outline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Authors
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.authors.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Author Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
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
                              placeholder="Enter author's biography">{{ old('biography') }}</textarea>
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
                           value="{{ old('photo') }}"
                           class="input-field @error('photo') border-red-500 @enderror"
                           placeholder="https://example.com/author-photo.jpg">
                    @error('photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">Optional: Enter a URL for the author's photo</p>
                </div>

                <!-- Birth Date and Nationality -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Birth Date</label>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               value="{{ old('birth_date') }}"
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
                               value="{{ old('nationality') }}"
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Author
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
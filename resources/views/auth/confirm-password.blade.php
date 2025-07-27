@extends('layouts.app')

@section('title', 'Confirm Password - BookStore')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-pink-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Secure Area</h2>
            <p class="mt-2 text-sm text-gray-600">Please confirm your password before continuing</p>
        </div>

        <!-- Confirm Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100">
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-amber-800">Security Check</h3>
                        <p class="text-xs text-amber-700 mt-1">
                            This is a secure area of the application. Please confirm your password before continuing.
                        </p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="current-password" 
                               required
                               class="input-field pl-10 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Enter your password">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary w-full text-lg py-3 magnetic ripple">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Confirm
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-blue-800">Why do we ask for this?</h3>
                    <p class="text-xs text-blue-700 mt-1">
                        Password confirmation helps protect your account by ensuring that only you can access sensitive areas of your account.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
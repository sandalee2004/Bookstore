@extends('layouts.app')

@section('title', 'Reset Password - BookStore')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Reset Password</h2>
            <p class="mt-2 text-sm text-gray-600">Enter your new password below</p>
        </div>

        <!-- Reset Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input id="email" 
                               name="email" 
                               type="email" 
                               autocomplete="email" 
                               required 
                               value="{{ old('email', $request->email) }}"
                               class="input-field pl-10 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Enter your email">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="new-password" 
                               required
                               class="input-field pl-10 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Enter new password">
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

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <input id="password_confirmation" 
                               name="password_confirmation" 
                               type="password" 
                               autocomplete="new-password" 
                               required
                               class="input-field pl-10 @error('password_confirmation') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Confirm new password">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary w-full text-lg py-3 magnetic ripple">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Reset Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Notice -->
        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-green-800">Secure Reset</h3>
                    <p class="text-xs text-green-700 mt-1">
                        Your password reset link is secure and will expire in 60 minutes for your protection.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
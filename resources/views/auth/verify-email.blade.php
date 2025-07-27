@extends('layouts.app')

@section('title', 'Verify Email - BookStore')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-orange-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">Verify Your Email</h2>
            <p class="mt-2 text-sm text-gray-600">We've sent a verification link to your email address</p>
        </div>

        <!-- Verification Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100">
            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-green-800 text-sm">A new verification link has been sent to your email address.</span>
                    </div>
                </div>
            @endif

            <div class="text-center space-y-4">
                <div class="bg-blue-50 rounded-xl p-6">
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-700">
                        Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
                    </p>
                </div>

                <div class="flex flex-col space-y-3">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-full magnetic ripple">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Text -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-yellow-800">Didn't receive the email?</h3>
                    <p class="text-xs text-yellow-700 mt-1">
                        Check your spam folder or click the resend button above. If you continue having issues, 
                        <a href="{{ route('contact') }}" class="underline">contact our support team</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
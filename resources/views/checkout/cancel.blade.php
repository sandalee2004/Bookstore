@extends('layouts.app')

@section('title', 'Payment Cancelled - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cancel Header -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Payment Cancelled</h1>
            <p class="text-xl text-gray-600">Your order was not completed. Your cart items are still saved.</p>
        </div>

        <!-- Information -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-8">
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">What happened?</h2>
                <p class="text-gray-600 mb-6">
                    Your payment was cancelled or failed to process. This could be due to:
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Payment Issues</h3>
                        <p class="text-sm text-gray-600">Insufficient funds, expired card, or payment method declined</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Technical Issues</h3>
                        <p class="text-sm text-gray-600">Network problems or payment gateway timeout</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-900 mb-4">What can you do next?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-blue-900">Check Your Cart</h3>
                        <p class="text-blue-700 text-sm">Your items are still saved in your cart. Review them before trying again.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-blue-900">Try Again</h3>
                        <p class="text-blue-700 text-sm">Use a different payment method or check your payment details.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-blue-900">Get Help</h3>
                        <p class="text-blue-700 text-sm">Contact our support team if you continue having issues.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('cart.index') }}" class="btn btn-primary text-lg px-8 py-3">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12"/>
                </svg>
                View Cart & Try Again
            </a>
            
            <a href="{{ route('books.index') }}" class="btn btn-outline text-lg px-8 py-3">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Continue Shopping
            </a>
            
            <a href="{{ route('contact') }}" class="btn btn-secondary text-lg px-8 py-3">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Contact Support
            </a>
        </div>

        <!-- Payment Security Notice -->
        <div class="text-center mt-8">
            <div class="bg-gray-100 rounded-xl p-6">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Your Information is Safe</h3>
                <p class="text-gray-600">
                    No charges were made to your account. All payment information is encrypted and secure.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
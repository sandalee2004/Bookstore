@extends('layouts.app')

@section('title', 'Order Confirmed - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Order Confirmed!</h1>
            <p class="text-xl text-gray-600">Thank you for your purchase. Your order has been successfully placed.</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-xl shadow-md p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Order Number</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Order Date</label>
                            <p class="text-gray-900">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Total Amount</label>
                            <p class="text-2xl font-bold text-green-600">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Payment Status</label>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-gray-700">{{ $order->shipping_address['address'] }}</p>
                        <p class="text-gray-700">
                            {{ $order->shipping_address['city'] }}, 
                            {{ $order->shipping_address['state'] }} 
                            {{ $order->shipping_address['zip_code'] }}
                        </p>
                        <p class="text-gray-700">{{ $order->shipping_address['country'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                            <img src="{{ $item->book->cover_image }}" 
                                 alt="{{ $item->book->title }}" 
                                 class="w-16 h-20 object-cover rounded">
                            
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $item->book->title }}</h3>
                                <p class="text-gray-600 text-sm">by {{ $item->book->author->name }}</p>
                                <p class="text-gray-500 text-sm">{{ $item->book->category->name }}</p>
                            </div>
                            
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Quantity</p>
                                <p class="font-semibold">{{ $item->quantity }}</p>
                            </div>
                            
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Price</p>
                                <p class="font-semibold">${{ number_format($item->price, 2) }}</p>
                            </div>
                            
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Total</p>
                                <p class="font-semibold text-lg">${{ number_format($item->total, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- What's Next -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-900 mb-4">What happens next?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-blue-900">Order Processing</h3>
                        <p class="text-blue-700 text-sm">Your payment was processed successfully. We'll prepare your books for shipment within 1-2 business days.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-blue-900">Shipping</h3>
                        <p class="text-blue-700 text-sm">Your order will be shipped and you'll receive a tracking number.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-medium text-blue-900">Delivery</h3>
                        <p class="text-blue-700 text-sm">Enjoy your new books! Delivery typically takes 2-5 business days.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary text-lg px-8 py-3">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                View Order Details
            </a>
            
            <a href="{{ route('books.index') }}" class="btn btn-outline text-lg px-8 py-3">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Continue Shopping
            </a>
        </div>

        <!-- Email Confirmation -->
        <div class="text-center mt-8">
            <div class="bg-gray-100 rounded-xl p-6">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Order Confirmation Sent</h3>
                <p class="text-gray-600">
                    We've sent an order confirmation email to <strong>{{ $order->user->email }}</strong>. 
                    You'll also receive shipping updates as your order progresses.
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Show success animation on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Add confetti effect or celebration animation here if desired
        showToast('🎉 Order placed successfully! Thank you for shopping with us.', 'success', 8000);
    });
</script>
@endpush
@endsection
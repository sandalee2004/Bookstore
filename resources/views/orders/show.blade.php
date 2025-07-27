@extends('layouts.app')

@section('title', 'Order #' . $order->order_number . ' - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Order #{{ $order->order_number }}</h1>
                <p class="text-gray-600">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="window.print()" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Order
                </button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Orders
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Status -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">Order Status</h2>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                               ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                               ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                               'bg-gray-100 text-gray-800'))) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Status Timeline -->
                    <div class="relative">
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                        
                        <div class="relative space-y-6">
                            <!-- Order Placed -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Order Placed</p>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>

                            <!-- Processing -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Processing</p>
                                    <p class="text-sm text-gray-500">
                                        @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                            Your order is being prepared
                                        @else
                                            Waiting for processing
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Shipped -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Shipped</p>
                                    <p class="text-sm text-gray-500">
                                        @if($order->shipped_at)
                                            Shipped on {{ $order->shipped_at->format('M d, Y') }}
                                        @elseif(in_array($order->status, ['shipped', 'delivered']))
                                            Your order has been shipped
                                        @else
                                            Waiting for shipment
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Delivered -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 {{ $order->status === 'delivered' ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Delivered</p>
                                    <p class="text-sm text-gray-500">
                                        @if($order->delivered_at)
                                            Delivered on {{ $order->delivered_at->format('M d, Y') }}
                                        @elseif($order->status === 'delivered')
                                            Your order has been delivered
                                        @else
                                            Pending delivery
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->status === 'pending' || $order->status === 'processing')
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <button onclick="cancelOrder({{ $order->id }})" 
                                    class="btn bg-red-600 text-white hover:bg-red-700">
                                Cancel Order
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-xl shadow-md p-6">
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
                                    <a href="{{ route('books.show', $item->book->slug) }}" 
                                       class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                        View Book
                                    </a>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-sm text-gray-500">Quantity</p>
                                    <p class="font-semibold">{{ $item->quantity }}</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="text-sm text-gray-500">Unit Price</p>
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

                <!-- Shipping Address -->
                <div class="bg-white rounded-xl shadow-md p-6">
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

            <!-- Order Summary -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax:</span>
                            <span class="font-medium">${{ number_format($order->tax_amount, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="font-medium">
                                @if($order->shipping_cost > 0)
                                    ${{ number_format($order->shipping_cost, 2) }}
                                @else
                                    <span class="text-green-600">FREE</span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold">Total:</span>
                                <span class="text-lg font-semibold text-blue-600">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Method:</span>
                            <span class="font-medium">{{ ucfirst($order->payment_method) }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                   ($order->payment_status === 'failed' ? 'bg-red-100 text-red-800' : 
                                   'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Need Help -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Need Help?</h3>
                    <p class="text-blue-700 text-sm mb-4">
                        Have questions about your order? Our customer service team is here to help.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary w-full text-sm">
                        Contact Support
                    </a>
                </div>

                @if($order->status === 'delivered')
                    <!-- Reorder -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Loved your books?</h3>
                        <p class="text-gray-600 text-sm mb-4">Order the same items again with one click.</p>
                        <button onclick="reorderItems()" class="btn btn-primary w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reorder Items
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function cancelOrder(orderId) {
        if (confirm('Are you sure you want to cancel this order?')) {
            fetch(`/orders/${orderId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Order cancelled successfully', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast(data.message || 'Error cancelling order', 'error');
                }
            })
            .catch(error => {
                showToast('Error cancelling order', 'error');
            });
        }
    }

    function reorderItems() {
        // Add all items from this order to cart
        const orderItems = @json($order->orderItems->pluck('book_id', 'quantity'));
        
        let promises = [];
        Object.entries(orderItems).forEach(([quantity, bookId]) => {
            promises.push(
                fetch(`/cart/add/${bookId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: parseInt(quantity) })
                })
            );
        });

        Promise.all(promises)
            .then(responses => Promise.all(responses.map(r => r.json())))
            .then(results => {
                const successful = results.filter(r => r.success).length;
                if (successful > 0) {
                    showToast(`${successful} items added to cart successfully!`, 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("cart.index") }}';
                    }, 1500);
                } else {
                    showToast('Error adding items to cart', 'error');
                }
            })
            .catch(error => {
                showToast('Error adding items to cart', 'error');
            });
    }
</script>
@endpush

<style>
    @media print {
        .no-print {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .bg-gray-50 {
            background: white !important;
        }
    }
</style>
@endsection
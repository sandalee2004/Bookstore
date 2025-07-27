@extends('layouts.app')

@section('title', 'My Orders - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">My Orders</h1>
            <p class="text-gray-600">Track and manage your book orders</p>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <!-- Order Header -->
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->order_number }}</h3>
                                    <p class="text-sm text-gray-600">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                                
                                <div class="mt-4 md:mt-0 flex items-center space-x-4">
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->orderItems->sum('quantity') }} {{ Str::plural('item', $order->orderItems->sum('quantity')) }}</p>
                                    </div>
                                    
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                        {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                           ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                           ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                           'bg-gray-100 text-gray-800'))) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($order->orderItems->take(3) as $item)
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $item->book->cover_image }}" 
                                             alt="{{ $item->book->title }}" 
                                             class="w-12 h-16 object-cover rounded">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-medium text-gray-900 truncate">{{ $item->book->title }}</h4>
                                            <p class="text-sm text-gray-600">by {{ $item->book->author->name }}</p>
                                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if($order->orderItems->count() > 3)
                                    <div class="flex items-center justify-center text-gray-500">
                                        <span class="text-sm">+{{ $order->orderItems->count() - 3 }} more items</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Actions -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center space-x-4 mb-3 sm:mb-0">
                                    @if($order->status === 'shipped' || $order->status === 'delivered')
                                        <div class="flex items-center text-green-600">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"/>
                                            </svg>
                                            <span class="text-sm font-medium">
                                                @if($order->status === 'shipped')
                                                    Shipped on {{ $order->shipped_at?->format('M d, Y') }}
                                                @else
                                                    Delivered on {{ $order->delivered_at?->format('M d, Y') }}
                                                @endif
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-3">
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline text-sm">
                                        View Details
                                    </a>
                                    
                                    @if($order->status === 'pending' || $order->status === 'processing')
                                        <button onclick="cancelOrder({{ $order->id }})" 
                                                class="btn bg-red-600 text-white hover:bg-red-700 text-sm">
                                            Cancel Order
                                        </button>
                                    @endif
                                    
                                    @if($order->status === 'delivered')
                                        <button class="btn btn-primary text-sm">
                                            Reorder
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">No orders yet</h2>
                <p class="text-gray-500 mb-8">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary text-lg px-8 py-3">
                    Start Shopping
                </a>
            </div>
        @endif
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
</script>
@endpush
@endsection
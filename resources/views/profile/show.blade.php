@extends('layouts.app')

@section('title', 'Dashboard - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome back, {{ $user->name }}!</h1>
            <p class="text-gray-600">Manage your account and view your orders</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Profile Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Name</label>
                            <p class="text-gray-900">{{ $user->name }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>
                        
                        @if($user->phone)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900">{{ $user->phone }}</p>
                        </div>
                        @endif
                        
                        @if($user->address)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Address</label>
                            <p class="text-gray-900">
                                {{ $user->address }}<br>
                                @if($user->city){{ $user->city }}, @endif
                                @if($user->state){{ $user->state }} @endif
                                @if($user->zip_code){{ $user->zip_code }}@endif
                                @if($user->country)<br>{{ $user->country }}@endif
                            </p>
                        </div>
                        @endif
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Member Since</label>
                            <p class="text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary w-full">
                            Edit Profile
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline w-full">
                            View All Orders
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h2 class="text-xl font-semibold mb-4">Quick Stats</h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Orders</span>
                            <span class="font-semibold text-gray-900">{{ $user->orders->count() }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Cart Items</span>
                            <span class="font-semibold text-gray-900">{{ $user->cart_items_count ?? 0 }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Spent</span>
                            <span class="font-semibold text-gray-900">
                                ${{ number_format($user->orders()->where('payment_status', 'paid')->sum('total_amount'), 2) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Recent Orders</h2>
                        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            View All
                        </a>
                    </div>
                    
                    @if($recentOrders->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentOrders as $order)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-semibold text-gray-900">Order #{{ $order->order_number }}</h3>
                                            <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-semibold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                                   ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                                   ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-gray-100 text-gray-800')) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4">
                                        @foreach($order->orderItems->take(3) as $item)
                                            <div class="flex items-center space-x-2">
                                                <img src="{{ $item->book->cover_image }}" 
                                                     alt="{{ $item->book->title }}" 
                                                     class="w-10 h-10 object-cover rounded">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $item->book->title }}</p>
                                                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->orderItems->count() > 3)
                                            <div class="text-sm text-gray-500">
                                                +{{ $order->orderItems->count() - 3 }} more
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="mt-3 flex justify-between items-center">
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            View Details
                                        </a>
                                        
                                        @if($order->status === 'pending')
                                            <button onclick="cancelOrder({{ $order->id }})" 
                                                    class="text-red-600 hover:text-red-700 text-sm font-medium">
                                                Cancel Order
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">No orders yet</h3>
                            <p class="text-gray-500 mb-4">Start shopping to see your orders here</p>
                            <a href="{{ route('books.index') }}" class="btn btn-primary">
                                Browse Books
                            </a>
                        </div>
                    @endif
                </div>
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
</script>
@endpush

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
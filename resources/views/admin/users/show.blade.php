@extends('layouts.app')

@section('title', $user->name . ' - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->name }}</h1>
                <p class="text-gray-600">User Details</p>
            </div>
            <div class="flex space-x-3">
                @if($user->id !== auth()->id())
                    <button onclick="toggleAdmin({{ $user->id }})" 
                            class="btn {{ $user->is_admin ? 'bg-yellow-600 text-white hover:bg-yellow-700' : 'bg-purple-600 text-white hover:bg-purple-700' }}">
                        {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                    </button>
                @endif
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Users
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- User Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                            {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $user->is_admin ? 'Administrator' : 'Regular User' }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>
                        
                        @if($user->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone</label>
                            <p class="text-gray-900">{{ $user->phone }}</p>
                        </div>
                        @endif
                        
                        @if($user->address)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Address</label>
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
                            <label class="block text-sm font-medium text-gray-500 mb-1">Member Since</label>
                            <p class="text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email Verified</label>
                            <p class="text-gray-900">
                                @if($user->email_verified_at)
                                    <span class="text-green-600">✓ Verified</span>
                                @else
                                    <span class="text-red-600">✗ Not Verified</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- User Stats -->
                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h3 class="text-lg font-semibold mb-4">User Statistics</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Orders</span>
                            <span class="font-semibold text-gray-900">{{ $user->orders->count() }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Spent</span>
                            <span class="font-semibold text-gray-900">
                                ${{ number_format($user->orders()->where('payment_status', 'paid')->sum('total_amount'), 2) }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Cart Items</span>
                            <span class="font-semibold text-gray-900">{{ $user->cartItems->count() }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Last Login</span>
                            <span class="font-semibold text-gray-900">{{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Orders -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-6">Recent Orders</h3>
                    
                    @if($user->orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->orders->take(10) as $order)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Order #{{ $order->order_number }}</h4>
                                            <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-semibold text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                                   ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                                   ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                                   'bg-gray-100 text-gray-800'))) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4 mb-3">
                                        @foreach($order->orderItems->take(3) as $item)
                                            <div class="flex items-center space-x-2">
                                                <img src="{{ $item->book->cover_image }}" 
                                                     alt="{{ $item->book->title }}" 
                                                     class="w-8 h-10 object-cover rounded">
                                                <div>
                                                    <p class="text-xs font-medium text-gray-900 line-clamp-1">{{ $item->book->title }}</p>
                                                    <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($order->orderItems->count() > 3)
                                            <div class="text-xs text-gray-500">
                                                +{{ $order->orderItems->count() - 3 }} more
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">
                                            {{ $order->orderItems->sum('quantity') }} {{ Str::plural('item', $order->orderItems->sum('quantity')) }}
                                        </span>
                                        <a href="{{ route('admin.orders.show', $order) }}" 
                                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            View Order
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($user->orders->count() > 10)
                            <div class="text-center mt-6">
                                <a href="{{ route('admin.orders.index', ['search' => $user->email]) }}" 
                                   class="btn btn-outline">
                                    View All Orders
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <h4 class="text-lg font-semibold text-gray-700 mb-2">No orders yet</h4>
                            <p class="text-gray-500">This user hasn't placed any orders.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleAdmin(userId) {
        const action = confirm('Are you sure you want to change this user\'s admin status?');
        if (!action) return;
        
        fetch(`/admin/users/${userId}/toggle-admin`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('User role updated successfully', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast('Error updating user role', 'error');
            }
        })
        .catch(error => {
            showToast('Error updating user role', 'error');
        });
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
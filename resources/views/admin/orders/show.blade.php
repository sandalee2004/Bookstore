@extends('layouts.app')

@section('title', 'Order #' . $order->order_number . ' - Admin')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Order #{{ $order->order_number }}</h1>
                <p class="text-gray-600">Order placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="printOrder()" class="btn btn-outline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Order
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
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

                <!-- Billing Address -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Billing Address</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-gray-700">{{ $order->billing_address['address'] }}</p>
                        <p class="text-gray-700">
                            {{ $order->billing_address['city'] }}, 
                            {{ $order->billing_address['state'] }} 
                            {{ $order->billing_address['zip_code'] }}
                        </p>
                        <p class="text-gray-700">{{ $order->billing_address['country'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Customer Info -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Customer Information</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Name</label>
                            <p class="text-gray-900">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $order->user->email }}</p>
                        </div>
                        @if($order->user->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-gray-900">{{ $order->user->phone }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Order Status -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Status</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Current Status:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                   ($order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : 
                                   ($order->status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                   'bg-gray-100 text-gray-800'))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Payment Status:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                   ($order->payment_status === 'failed' ? 'bg-red-100 text-red-800' : 
                                   'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>

                        @if($order->shipped_at)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Shipped:</span>
                            <span class="text-sm text-gray-900">{{ $order->shipped_at->format('M d, Y') }}</span>
                        </div>
                        @endif

                        @if($order->delivered_at)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Delivered:</span>
                            <span class="text-sm text-gray-900">{{ $order->delivered_at->format('M d, Y') }}</span>
                        </div>
                        @endif

                        @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                        <div class="pt-4 border-t border-gray-200">
                            <button onclick="updateOrderStatus({{ $order->id }})" 
                                    class="btn btn-primary w-full">
                                Update Status
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

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
                            <span class="font-medium">{{ ucfirst($order->payment_status) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="status-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50" onclick="closeStatusModal()"></div>
        <div class="relative bg-white rounded-xl max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Update Order Status</h3>
            <form id="status-form">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                    <select id="new-status" class="input-field">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="saveStatusUpdate()" class="btn btn-primary flex-1">
                        Update Status
                    </button>
                    <button type="button" onclick="closeStatusModal()" class="btn btn-secondary">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateOrderStatus(orderId) {
        document.getElementById('status-modal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('status-modal').classList.add('hidden');
    }

    function saveStatusUpdate() {
        const newStatus = document.getElementById('new-status').value;
        
        fetch(`/admin/orders/{{ $order->id }}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Order status updated successfully', 'success');
                closeStatusModal();
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast('Error updating order status', 'error');
            }
        })
        .catch(error => {
            showToast('Error updating order status', 'error');
        });
    }

    function printOrder() {
        window.print();
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
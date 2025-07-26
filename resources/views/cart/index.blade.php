@extends('layouts.app')

@section('title', 'Shopping Cart - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
            <p class="text-gray-600">Review your items before checkout</p>
        </div>

        @if(isset($cartItems) && $cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold">Items in your cart ({{ $cartItems->count() }})</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="p-6 flex items-center space-x-4" id="cart-item-{{ $item->id }}">
                                    <img src="{{ $item->book->cover_image }}" 
                                         alt="{{ $item->book->title }}" 
                                         class="w-20 h-20 object-cover rounded-lg">
                                    
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-gray-900">{{ $item->book->title }}</h3>
                                        <p class="text-gray-600 text-sm">by {{ $item->book->author->name }}</p>
                                        <p class="text-gray-500 text-sm">{{ $item->book->category->name }}</p>
                                        
                                        @if($item->book->discount_price)
                                            <div class="flex items-center space-x-2 mt-1">
                                                <span class="text-lg font-bold text-blue-600">${{ number_format($item->book->discount_price, 2) }}</span>
                                                <span class="text-sm text-gray-500 line-through">${{ number_format($item->book->price, 2) }}</span>
                                            </div>
                                        @else
                                            <span class="text-lg font-bold text-blue-600">${{ number_format($item->book->price, 2) }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                                    class="p-2 hover:bg-gray-100 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </button>
                                            
                                            <input type="number" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->book->stock_quantity }}"
                                                   class="w-16 text-center border-0 focus:ring-0"
                                                   onchange="updateQuantity({{ $item->id }}, this.value)">
                                            
                                            <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                                    class="p-2 hover:bg-gray-100 {{ $item->quantity >= $item->book->stock_quantity ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    {{ $item->quantity >= $item->book->stock_quantity ? 'disabled' : '' }}>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                            </button>
                                        </div>
                                        
                                        <button onclick="removeItem({{ $item->id }})" 
                                                class="text-red-600 hover:text-red-700 p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="text-right">
                                        <div class="font-semibold text-lg text-gray-900" id="item-total-{{ $item->id }}">
                                            ${{ number_format($item->book->final_price * $item->quantity, 2) }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ${{ number_format($item->book->final_price, 2) }} each
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="p-6 bg-gray-50 flex justify-between items-center">
                            <button onclick="clearCart()" class="text-red-600 hover:text-red-700 font-medium">
                                Clear Cart
                            </button>
                            <a href="{{ route('books.index') }}" class="btn btn-outline">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-8">
                        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                <span class="font-medium" id="cart-subtotal">${{ number_format($total, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">
                                    @if($total >= 50)
                                        <span class="text-green-600">FREE</span>
                                    @else
                                        $9.99
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax</span>
                                <span class="font-medium">${{ number_format($total * 0.08, 2) }}</span>
                            </div>
                            
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold">Total</span>
                                    <span class="text-lg font-semibold text-blue-600" id="cart-total">
                                        ${{ number_format($total + ($total >= 50 ? 0 : 9.99) + ($total * 0.08), 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        @if($total >= 50)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-green-800 text-sm font-medium">You qualify for FREE shipping!</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                <div class="text-blue-800 text-sm">
                                    <strong>Add ${{ number_format(50 - $total, 2) }} more</strong> to qualify for FREE shipping!
                                </div>
                            </div>
                        @endif
                        
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-full text-lg py-3 mb-3">
                            Proceed to Checkout
                        </a>
                        
                        <div class="text-center text-sm text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Secure checkout with SSL encryption
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12M7 13v6a1 1 0 001 1h8a1 1 0 001-1v-6M7 13l-2.4-8M15 17a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added any books to your cart yet.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary text-lg px-8 py-3">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function updateQuantity(itemId, quantity) {
        if (quantity < 1) return;
        
        fetch(`/cart/update/${itemId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity: parseInt(quantity) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update item total
                document.getElementById(`item-total-${itemId}`).textContent = `$${data.item_total}`;
                // Update cart total
                document.getElementById('cart-total').textContent = `$${data.cart_total}`;
                showToast('Cart updated successfully', 'success');
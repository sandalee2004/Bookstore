@extends('layouts.app')

@section('title', 'Checkout - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout</h1>
            <p class="text-gray-600">Complete your order</p>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            
            <!-- Checkout Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Address -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Street Address *</label>
                            <input type="text" 
                                   id="shipping_address" 
                                   name="shipping_address[address]" 
                                   value="{{ old('shipping_address.address', auth()->user()->address) }}" 
                                   required
                                   class="input-field @error('shipping_address.address') border-red-500 @enderror"
                                   placeholder="Enter your street address">
                            @error('shipping_address.address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                            <input type="text" 
                                   id="shipping_city" 
                                   name="shipping_address[city]" 
                                   value="{{ old('shipping_address.city', auth()->user()->city) }}" 
                                   required
                                   class="input-field @error('shipping_address.city') border-red-500 @enderror"
                                   placeholder="Enter city">
                            @error('shipping_address.city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-2">State/Province *</label>
                            <input type="text" 
                                   id="shipping_state" 
                                   name="shipping_address[state]" 
                                   value="{{ old('shipping_address.state', auth()->user()->state) }}" 
                                   required
                                   class="input-field @error('shipping_address.state') border-red-500 @enderror"
                                   placeholder="Enter state/province">
                            @error('shipping_address.state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_zip" class="block text-sm font-medium text-gray-700 mb-2">ZIP/Postal Code *</label>
                            <input type="text" 
                                   id="shipping_zip" 
                                   name="shipping_address[zip_code]" 
                                   value="{{ old('shipping_address.zip_code', auth()->user()->zip_code) }}" 
                                   required
                                   class="input-field @error('shipping_address.zip_code') border-red-500 @enderror"
                                   placeholder="Enter ZIP/postal code">
                            @error('shipping_address.zip_code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                            <input type="text" 
                                   id="shipping_country" 
                                   name="shipping_address[country]" 
                                   value="{{ old('shipping_address.country', auth()->user()->country) }}" 
                                   required
                                   class="input-field @error('shipping_address.country') border-red-500 @enderror"
                                   placeholder="Enter country">
                            @error('shipping_address.country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">Billing Address</h2>
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   id="billing_same_as_shipping" 
                                   name="billing_same_as_shipping" 
                                   value="1"
                                   checked
                                   onchange="toggleBillingAddress()"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">Same as shipping address</span>
                        </label>
                    </div>

                    <div id="billing-address-fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-2">Street Address *</label>
                            <input type="text" 
                                   id="billing_address" 
                                   name="billing_address[address]" 
                                   value="{{ old('billing_address.address') }}" 
                                   class="input-field @error('billing_address.address') border-red-500 @enderror"
                                   placeholder="Enter billing address">
                            @error('billing_address.address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                            <input type="text" 
                                   id="billing_city" 
                                   name="billing_address[city]" 
                                   value="{{ old('billing_address.city') }}" 
                                   class="input-field @error('billing_address.city') border-red-500 @enderror"
                                   placeholder="Enter city">
                            @error('billing_address.city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="billing_state" class="block text-sm font-medium text-gray-700 mb-2">State/Province *</label>
                            <input type="text" 
                                   id="billing_state" 
                                   name="billing_address[state]" 
                                   value="{{ old('billing_address.state') }}" 
                                   class="input-field @error('billing_address.state') border-red-500 @enderror"
                                   placeholder="Enter state/province">
                            @error('billing_address.state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="billing_zip" class="block text-sm font-medium text-gray-700 mb-2">ZIP/Postal Code *</label>
                            <input type="text" 
                                   id="billing_zip" 
                                   name="billing_address[zip_code]" 
                                   value="{{ old('billing_address.zip_code') }}" 
                                   class="input-field @error('billing_address.zip_code') border-red-500 @enderror"
                                   placeholder="Enter ZIP/postal code">
                            @error('billing_address.zip_code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="billing_country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                            <input type="text" 
                                   id="billing_country" 
                                   name="billing_address[country]" 
                                   value="{{ old('billing_address.country') }}" 
                                   class="input-field @error('billing_address.country') border-red-500 @enderror"
                                   placeholder="Enter country">
                            @error('billing_address.country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
                    <div class="space-y-4">
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="credit_card" 
                                   checked
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                            <div class="ml-3 flex items-center">
                                <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <span class="font-medium">Credit Card</span>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="paypal"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                            <div class="ml-3 flex items-center">
                                <svg class="w-6 h-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.541c-.013.076-.026.175-.041.26-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 0 0-.556.479l-1.187 7.527h-.506l-.24 1.516a.641.641 0 0 0 .633.74h3.94a.563.563 0 0 0 .556-.479l.24-1.516h.506l.72-4.56a.563.563 0 0 1 .556-.479h1.367c3.49 0 6.227-1.417 7.032-5.523.362-1.847.2-3.416-.285-4.625z"/>
                                </svg>
                                <span class="font-medium">PayPal</span>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="stripe"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                            <div class="ml-3 flex items-center">
                                <svg class="w-6 h-6 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/>
                                </svg>
                                <span class="font-medium">Stripe</span>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-8">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    
                    <!-- Cart Items -->
                    <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                            <div class="flex items-center space-x-3">
                                <img src="{{ $item->book->cover_image }}" 
                                     alt="{{ $item->book->title }}" 
                                     class="w-12 h-16 object-cover rounded">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-gray-900 text-sm truncate">{{ $item->book->title }}</h4>
                                    <p class="text-xs text-gray-600">Qty: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($item->book->final_price * $item->quantity, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pricing Breakdown -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                            <span class="font-medium">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">
                                @if($shippingCost > 0)
                                    ${{ number_format($shippingCost, 2) }}
                                @else
                                    <span class="text-green-600">FREE</span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax</span>
                            <span class="font-medium">${{ number_format($taxAmount, 2) }}</span>
                        </div>
                        
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold">Total</span>
                                <span class="text-lg font-semibold text-blue-600">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @if($shippingCost == 0)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-green-800 text-sm font-medium">You qualify for FREE shipping!</span>
                            </div>
                        </div>
                    @endif
                    
                    <button type="submit" class="btn btn-primary w-full text-lg py-3 mb-3">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Place Order
                    </button>
                    
                    <div class="text-center text-sm text-gray-500">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Secure checkout with SSL encryption
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleBillingAddress() {
        const checkbox = document.getElementById('billing_same_as_shipping');
        const billingFields = document.getElementById('billing-address-fields');
        
        if (checkbox.checked) {
            billingFields.classList.add('hidden');
        } else {
            billingFields.classList.remove('hidden');
        }
    }
</script>
@endpush
@endsection
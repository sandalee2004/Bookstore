@extends('layouts.app')

@section('title', 'FAQ - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
            <p class="text-xl text-gray-600">Find answers to common questions about our bookstore</p>
        </div>

        <!-- FAQ Categories -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <a href="#ordering" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Ordering</h3>
            </a>
            
            <a href="#shipping" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Shipping</h3>
            </a>
            
            <a href="#returns" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Returns</h3>
            </a>
        </div>

        <!-- FAQ Sections -->
        <div class="space-y-8">
            <!-- Ordering -->
            <section id="ordering" class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-2xl font-semibold mb-6 text-blue-600">Ordering</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">How do I place an order?</h3>
                        <p class="text-gray-600">Simply browse our catalog, add books to your cart, and proceed to checkout. You'll need to create an account or sign in to complete your purchase.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">What payment methods do you accept?</h3>
                        <p class="text-gray-600">We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and Stripe payments. All transactions are secure and encrypted.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Can I modify or cancel my order?</h3>
                        <p class="text-gray-600">You can modify or cancel your order within 1 hour of placing it, provided it hasn't been processed for shipping. Contact our customer service team for assistance.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Do you offer bulk discounts?</h3>
                        <p class="text-gray-600">Yes, we offer discounts for bulk orders of 20 or more books. Please contact our sales team for custom pricing.</p>
                    </div>
                </div>
            </section>

            <!-- Shipping -->
            <section id="shipping" class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-2xl font-semibold mb-6 text-green-600">Shipping & Delivery</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">How long does shipping take?</h3>
                        <p class="text-gray-600">Standard shipping takes 2-5 business days within the US. Express shipping (1-2 business days) and overnight shipping are also available for an additional fee.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Do you offer free shipping?</h3>
                        <p class="text-gray-600">Yes! We offer free standard shipping on orders over $50 within the United States.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Do you ship internationally?</h3>
                        <p class="text-gray-600">Yes, we ship to most countries worldwide. International shipping rates and delivery times vary by destination. Customs fees may apply.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">How can I track my order?</h3>
                        <p class="text-gray-600">Once your order ships, you'll receive a tracking number via email. You can also track your order by logging into your account and viewing your order history.</p>
                    </div>
                </div>
            </section>

            <!-- Returns -->
            <section id="returns" class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-2xl font-semibold mb-6 text-purple-600">Returns & Refunds</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">What is your return policy?</h3>
                        <p class="text-gray-600">We accept returns of unopened books in original condition within 30 days of purchase. Books must be in resalable condition.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">How do I return an item?</h3>
                        <p class="text-gray-600">Contact our customer service team to initiate a return. We'll provide you with a return authorization number and shipping instructions.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Who pays for return shipping?</h3>
                        <p class="text-gray-600">Return shipping costs are the customer's responsibility unless the return is due to our error (wrong item sent, damaged item, etc.).</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">How long does it take to process a refund?</h3>
                        <p class="text-gray-600">Refunds are processed within 3-5 business days after we receive your returned item. The refund will appear on your original payment method within 5-10 business days.</p>
                    </div>
                </div>
            </section>

            <!-- Account & Technical -->
            <section class="bg-white rounded-xl shadow-md p-8">
                <h2 class="text-2xl font-semibold mb-6 text-orange-600">Account & Technical</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Do I need an account to make a purchase?</h3>
                        <p class="text-gray-600">Yes, you need to create an account to place orders. This allows you to track your orders, save your preferences, and access your order history.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">I forgot my password. How can I reset it?</h3>
                        <p class="text-gray-600">Click on "Forgot Password" on the login page and enter your email address. We'll send you instructions to reset your password.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Is my personal information secure?</h3>
                        <p class="text-gray-600">Yes, we use industry-standard SSL encryption to protect your personal and payment information. We never store your credit card details on our servers.</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Can I change my account information?</h3>
                        <p class="text-gray-600">Yes, you can update your account information, including your name, email, address, and password, by logging into your account and visiting the profile section.</p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Still have questions -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-8 mt-12 text-center">
            <h2 class="text-2xl font-semibold text-blue-900 mb-4">Still have questions?</h2>
            <p class="text-blue-700 mb-6">Can't find the answer you're looking for? Our customer support team is here to help.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">
                Contact Support
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
@endsection
@extends('layouts.app')

@section('title', 'Terms and Conditions - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Terms and Conditions</h1>
            <p class="text-xl text-gray-600">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8 prose prose-lg max-w-none">
            <h2>Agreement to Terms</h2>
            <p>
                By accessing and using BookStore's website and services, you accept and agree to be bound by the terms 
                and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
            </p>

            <h2>Use License</h2>
            <p>
                Permission is granted to temporarily download one copy of the materials on BookStore's website for personal, 
                non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
            </p>
            <ul>
                <li>Modify or copy the materials</li>
                <li>Use the materials for any commercial purpose or for any public display</li>
                <li>Attempt to reverse engineer any software contained on the website</li>
                <li>Remove any copyright or other proprietary notations from the materials</li>
            </ul>

            <h2>Account Terms</h2>
            <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times.</p>
            <ul>
                <li>You are responsible for safeguarding the password and for all activities under your account</li>
                <li>You must notify us immediately of any unauthorized use of your account</li>
                <li>We reserve the right to terminate accounts that violate these terms</li>
            </ul>

            <h2>Products and Services</h2>
            <h3>Product Information</h3>
            <p>
                We strive to provide accurate product descriptions, pricing, and availability information. However, 
                we do not warrant that product descriptions or other content is accurate, complete, reliable, current, or error-free.
            </p>

            <h3>Pricing</h3>
            <p>
                All prices are subject to change without notice. We reserve the right to modify or discontinue products 
                at any time without notice. Prices do not include applicable taxes or shipping costs unless otherwise stated.
            </p>

            <h2>Orders and Payment</h2>
            <h3>Order Acceptance</h3>
            <p>
                We reserve the right to refuse or cancel any order for any reason, including but not limited to:
            </p>
            <ul>
                <li>Product availability</li>
                <li>Errors in product or pricing information</li>
                <li>Suspected fraudulent activity</li>
                <li>Violation of these terms</li>
            </ul>

            <h3>Payment</h3>
            <p>
                Payment must be received before we ship your order. We accept major credit cards and other payment methods 
                as indicated on our website. You represent that you have the legal right to use any payment method you provide.
            </p>

            <h2>Shipping and Delivery</h2>
            <p>
                We will make every effort to ship your order promptly. Shipping times are estimates and not guaranteed. 
                Risk of loss and title for items pass to you upon delivery to the carrier.
            </p>

            <h2>Returns and Refunds</h2>
            <p>
                We accept returns of unopened items in original condition within 30 days of purchase. 
                Return shipping costs are the responsibility of the customer unless the return is due to our error.
            </p>

            <h2>Prohibited Uses</h2>
            <p>You may not use our service:</p>
            <ul>
                <li>For any unlawful purpose or to solicit others to perform unlawful acts</li>
                <li>To violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances</li>
                <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                <li>To harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate</li>
                <li>To submit false or misleading information</li>
                <li>To upload or transmit viruses or any other type of malicious code</li>
            </ul>

            <h2>Intellectual Property</h2>
            <p>
                The service and its original content, features, and functionality are and will remain the exclusive property 
                of BookStore and its licensors. The service is protected by copyright, trademark, and other laws.
            </p>

            <h2>Disclaimer</h2>
            <p>
                The information on this website is provided on an "as is" basis. To the fullest extent permitted by law, 
                this Company excludes all representations, warranties, conditions and terms whether express or implied.
            </p>

            <h2>Limitation of Liability</h2>
            <p>
                In no event shall BookStore, nor its directors, employees, partners, agents, suppliers, or affiliates, 
                be liable for any indirect, incidental, special, consequential, or punitive damages, including without 
                limitation, loss of profits, data, use, goodwill, or other intangible losses.
            </p>

            <h2>Governing Law</h2>
            <p>
                These terms shall be governed and construed in accordance with the laws of the United States, 
                without regard to its conflict of law provisions.
            </p>

            <h2>Changes to Terms</h2>
            <p>
                We reserve the right, at our sole discretion, to modify or replace these Terms at any time. 
                If a revision is material, we will try to provide at least 30 days notice prior to any new terms taking effect.
            </p>

            <h2>Contact Information</h2>
            <p>
                If you have any questions about these Terms and Conditions, please contact us at:
            </p>
            <ul>
                <li>Email: legal@bookstore.com</li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Address: 123 Book Street, Reading City, RC 12345, United States</li>
            </ul>
        </div>
    </div>
</div>
@endsection
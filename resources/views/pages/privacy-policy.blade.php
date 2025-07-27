@extends('layouts.app')

@section('title', 'Privacy Policy - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Privacy Policy</h1>
            <p class="text-xl text-gray-600">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-8 prose prose-lg max-w-none">
            <h2>Introduction</h2>
            <p>
                At BookStore, we are committed to protecting your privacy and ensuring the security of your personal information. 
                This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website 
                and use our services.
            </p>

            <h2>Information We Collect</h2>
            <h3>Personal Information</h3>
            <p>We may collect personal information that you provide directly to us, including:</p>
            <ul>
                <li>Name and contact information (email address, phone number, mailing address)</li>
                <li>Account credentials (username and password)</li>
                <li>Payment information (credit card details, billing address)</li>
                <li>Order history and preferences</li>
                <li>Communication preferences</li>
            </ul>

            <h3>Automatically Collected Information</h3>
            <p>We automatically collect certain information when you visit our website:</p>
            <ul>
                <li>IP address and browser information</li>
                <li>Device information and operating system</li>
                <li>Pages visited and time spent on our site</li>
                <li>Referring website information</li>
                <li>Cookies and similar tracking technologies</li>
            </ul>

            <h2>How We Use Your Information</h2>
            <p>We use the information we collect for various purposes, including:</p>
            <ul>
                <li>Processing and fulfilling your orders</li>
                <li>Providing customer support and responding to inquiries</li>
                <li>Personalizing your shopping experience</li>
                <li>Sending promotional emails and newsletters (with your consent)</li>
                <li>Improving our website and services</li>
                <li>Preventing fraud and ensuring security</li>
                <li>Complying with legal obligations</li>
            </ul>

            <h2>Information Sharing and Disclosure</h2>
            <p>We do not sell, trade, or rent your personal information to third parties. We may share your information in the following circumstances:</p>
            <ul>
                <li><strong>Service Providers:</strong> With trusted third-party service providers who assist us in operating our website and conducting business</li>
                <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
                <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                <li><strong>Consent:</strong> With your explicit consent for specific purposes</li>
            </ul>

            <h2>Data Security</h2>
            <p>
                We implement appropriate technical and organizational security measures to protect your personal information against 
                unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet 
                or electronic storage is 100% secure.
            </p>

            <h2>Cookies and Tracking Technologies</h2>
            <p>
                We use cookies and similar tracking technologies to enhance your browsing experience, analyze website traffic, 
                and personalize content. You can control cookie settings through your browser preferences.
            </p>

            <h2>Your Rights and Choices</h2>
            <p>You have the following rights regarding your personal information:</p>
            <ul>
                <li><strong>Access:</strong> Request access to your personal information</li>
                <li><strong>Correction:</strong> Request correction of inaccurate information</li>
                <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                <li><strong>Portability:</strong> Request a copy of your data in a portable format</li>
                <li><strong>Opt-out:</strong> Unsubscribe from marketing communications</li>
            </ul>

            <h2>Children's Privacy</h2>
            <p>
                Our services are not intended for children under 13 years of age. We do not knowingly collect personal information 
                from children under 13. If we become aware that we have collected such information, we will take steps to delete it.
            </p>

            <h2>International Data Transfers</h2>
            <p>
                Your information may be transferred to and processed in countries other than your own. We ensure appropriate 
                safeguards are in place to protect your information during such transfers.
            </p>

            <h2>Changes to This Privacy Policy</h2>
            <p>
                We may update this Privacy Policy from time to time. We will notify you of any material changes by posting 
                the new Privacy Policy on this page and updating the "Last updated" date.
            </p>

            <h2>Contact Us</h2>
            <p>
                If you have any questions about this Privacy Policy or our privacy practices, please contact us at:
            </p>
            <ul>
                <li>Email: privacy@bookstore.com</li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Address: 123 Book Street, Reading City, RC 12345, United States</li>
            </ul>
        </div>
    </div>
</div>
@endsection
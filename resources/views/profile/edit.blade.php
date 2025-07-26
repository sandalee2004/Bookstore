@extends('layouts.app')

@section('title', 'Edit Profile - BookStore')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Profile</h1>
            <p class="text-gray-600">Update your account information</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Personal Information</h2>
                    
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   class="input-field @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   class="input-field @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800">
                                        Your email address is unverified.
                                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Click here to re-send the verification email.
                                        </button>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $user->phone) }}"
                                   class="input-field @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                            <textarea id="address" 
                                      name="address" 
                                      rows="3"
                                      class="input-field @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City, State, ZIP -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input type="text" 
                                       id="city" 
                                       name="city" 
                                       value="{{ old('city', $user->city) }}"
                                       class="input-field @error('city') border-red-500 @enderror">
                                @error('city')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                                <input type="text" 
                                       id="state" 
                                       name="state" 
                                       value="{{ old('state', $user->state) }}"
                                       class="input-field @error('state') border-red-500 @enderror">
                                @error('state')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">ZIP/Postal Code</label>
                                <input type="text" 
                                       id="zip_code" 
                                       name="zip_code" 
                                       value="{{ old('zip_code', $user->zip_code) }}"
                                       class="input-field @error('zip_code') border-red-500 @enderror">
                                @error('zip_code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" 
                                   id="country" 
                                   name="country" 
                                   value="{{ old('country', $user->country) }}"
                                   class="input-field @error('country') border-red-500 @enderror">
                            @error('country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            
                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-green-600">Saved successfully!</p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h2 class="text-xl font-semibold mb-6">Change Password</h2>
                    
                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <!-- Current Password -->
                        <div>
                            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" 
                                   id="update_password_current_password" 
                                   name="current_password" 
                                   autocomplete="current-password"
                                   class="input-field @error('current_password', 'updatePassword') border-red-500 @enderror">
                            @error('current_password', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" 
                                   id="update_password_password" 
                                   name="password" 
                                   autocomplete="new-password"
                                   class="input-field @error('password', 'updatePassword') border-red-500 @enderror">
                            @error('password', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" 
                                   id="update_password_password_confirmation" 
                                   name="password_confirmation" 
                                   autocomplete="new-password"
                                   class="input-field @error('password_confirmation', 'updatePassword') border-red-500 @enderror">
                            @error('password_confirmation', 'updatePassword')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                            
                            @if (session('status') === 'password-updated')
                                <p class="text-sm text-green-600">Password updated successfully!</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Account Actions</h2>
                    
                    <div class="space-y-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline w-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7z"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        
                        <a href="{{ route('orders.index') }}" class="btn btn-outline w-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            My Orders
                        </a>
                        
                        <a href="{{ route('cart.index') }}" class="btn btn-outline w-full">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 8L6 18h12"/>
                            </svg>
                            Shopping Cart
                        </a>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h2 class="text-xl font-semibold mb-4 text-red-600">Danger Zone</h2>
                    <p class="text-sm text-gray-600 mb-4">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                    </p>
                    
                    <button onclick="confirmDelete()" class="btn bg-red-600 text-white hover:bg-red-700 w-full">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Verification Form -->
@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
@endif

<!-- Delete Account Modal -->
<div id="delete-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black opacity-50" onclick="closeDeleteModal()"></div>
        <div class="relative bg-white rounded-xl max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4 text-red-600">Delete Account</h3>
            <p class="text-gray-600 mb-4">
                Are you sure you want to delete your account? This action cannot be undone.
            </p>
            
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Please enter your password to confirm:
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           class="input-field">
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 flex-1">
                        Delete Account
                    </button>
                    <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete() {
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }
</script>
@endpush
@endsection
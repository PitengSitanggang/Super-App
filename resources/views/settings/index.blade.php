@extends('layouts.app')
@section('header_title', 'Settings')
@section('content')
<div class="max-w-4xl mx-auto" x-data="{ tab: 'profile' }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
        <p class="text-gray-500 mt-2">Manage your account profile and application preferences.</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <button @click="tab = 'profile'" :class="{ 'border-blue-500 text-blue-600': tab === 'profile', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'profile' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                My Profile
            </button>
            @if(in_array(auth()->user()->role, ['superadmin', 'admin']))
            <button @click="tab = 'app'" :class="{ 'border-blue-500 text-blue-600': tab === 'app', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'app' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                App Settings
            </button>
            @endif
        </nav>
    </div>

    <!-- Tab Contents -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Profile Tab -->
        <div x-show="tab === 'profile'" class="p-6 sm:p-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Profile Information</h2>
            <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img class="h-16 w-16 object-cover rounded-full shadow-sm" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" alt="Avatar">
                        </div>
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" name="avatar" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"/>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Change Password</h3>
                    <p class="text-sm text-gray-500 mb-4">Leave blank if you don't want to change your password.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- App Settings Tab -->
        @if(in_array(auth()->user()->role, ['superadmin', 'admin']))
        <div x-show="tab === 'app'" style="display: none;" class="p-6 sm:p-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Application Settings</h2>
            <form action="{{ route('settings.app.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="app_name" class="block text-sm font-medium text-gray-700 mb-1">Application Name</label>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $settings['app_name'] ?? config('app.name')) }}" class="mt-1 block w-full md:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <div class="mb-6 border-t border-gray-200 pt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Application Logo</label>
                    <div class="flex items-start space-x-6">
                        <div class="shrink-0 bg-gray-50 p-2 border border-gray-200 rounded-lg">
                            @if(isset($settings['app_logo']) && $settings['app_logo'])
                                <img class="h-16 w-auto object-contain" src="{{ asset('storage/' . $settings['app_logo']) }}" alt="App Logo">
                            @else
                                <div class="h-16 w-16 flex items-center justify-center text-gray-400">No Logo</div>
                            @endif
                        </div>
                        <label class="block flex-1">
                            <span class="sr-only">Choose app logo</span>
                            <input type="file" name="app_logo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"/>
                            <p class="text-xs text-gray-500 mt-2">Recommended size: 200x50px. Max size: 2MB.</p>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out">
                        Save App Settings
                    </button>
                </div>
            </form>
        </div>
        @endif
        
    </div>
</div>

<!-- Add Alpine.js for Tabs -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection

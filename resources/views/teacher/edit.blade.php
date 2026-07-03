@extends('layouts.app')
@section('header_title', 'Edit Teacher')
@section('content')
<div class="max-w-2xl w-full">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-800">Edit Teacher: {{ $teacher->name }}</h1>
            <a href="{{ route('teachers.index') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to List
            </a>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- User Account Section -->
                    <div class="md:col-span-2">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Account Details</h2>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $teacher->user->email ?? '') }}" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Password <span class="text-gray-400 font-normal">(Kosongkan jika tidak ingin diubah)</span></label>
                        <input type="password" name="password"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teacher Profile Section -->
                    <div class="md:col-span-2 mt-2">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Teacher Profile</h2>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Employee Number (NIP)</label>
                        <input type="text" name="employee_number" value="{{ old('employee_number', $teacher->employee_number) }}" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('employee_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Gender</label>
                        <select name="gender" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                            <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $teacher->phone_number) }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Status</label>
                        <select name="status" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                            <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Mata Pelajaran yang Diampu:</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach($subjects as $mapel)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="subject_ids[]" value="{{ $mapel->id }}"
                                        class="form-checkbox text-blue-600"
                                        {{ $teacher->subjects->contains($mapel->id) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $mapel->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('subject_ids')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex gap-4">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Teacher Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
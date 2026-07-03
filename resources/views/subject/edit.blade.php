@extends('layouts.app')
@section('header_title', 'Edit Subject')
@section('content')
<div class="max-w-xl w-full">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-800">Edit Subject</h1>
            <a href="{{ route('subjects.index') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to List
            </a>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Subject Code</label>
                        <input type="text" name="code" value="{{ old('code', $subject->code) }}" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                        @error('code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Subject Name</label>
                        <input type="text" name="name" value="{{ old('name', $subject->name) }}" required
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Subject Group <span class="text-gray-400 font-normal">(Optional)</span></label>
                        <select name="group" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition bg-white">
                            <option value="">Select Group</option>
                            <option value="Science" {{ old('group', $subject->group) == 'Science' ? 'selected' : '' }}>Science</option>
                            <option value="Arts" {{ old('group', $subject->group) == 'Arts' ? 'selected' : '' }}>Arts</option>
                            <option value="Language" {{ old('group', $subject->group) == 'Language' ? 'selected' : '' }}>Language</option>
                            <option value="Physical Education" {{ old('group', $subject->group) == 'Physical Education' ? 'selected' : '' }}>Physical Education</option>
                            <option value="Technology" {{ old('group', $subject->group) == 'Technology' ? 'selected' : '' }}>Technology</option>
                        </select>
                        @error('group')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
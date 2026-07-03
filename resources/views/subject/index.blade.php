@extends('layouts.app')
@section('header_title', 'Manage Subjects')
@section('content')
<div class="max-w-6xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Subjects Data</h1>
                <p class="text-gray-500 mt-1">Manage active subjects and curriculum groups.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('subjects.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Subject
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                            <th class="py-4 px-6 font-semibold">Subject Code</th>
                            <th class="py-4 px-6 font-semibold">Name</th>
                            <th class="py-4 px-6 font-semibold">Group</th>
                            <th class="py-4 px-6 font-semibold">Teachers</th>
                            <th class="py-4 px-6 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($subjects as $subject)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="py-4 px-6 text-gray-800 font-medium">{{ $subject->code }}</td>
                                <td class="py-4 px-6 text-gray-600 font-medium">{{ $subject->name }}</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-medium">
                                        {{ $subject->group ?? 'General' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    <span class="bg-purple-50 text-purple-700 py-1 px-2 rounded-full text-xs font-bold">{{ $subject->teachers_count ?? 0 }}</span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('subjects.edit', $subject->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">Edit</a>
                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this subject?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 px-6 text-center text-gray-500">
                                    No subjects found. Click "Add Subject" to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($subjects->hasPages())
                <div class="p-4 border-t border-gray-100">
                    {{ $subjects->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
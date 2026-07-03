@extends('layouts.app')
@section('header_title', 'Manage Students')
@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Student Data</h1>
        <div class="flex items-center space-x-3">
            <!-- Import Form -->
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2 bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm">
                @csrf
                <input type="file" name="file" required class="text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1.5 px-4 rounded-md shadow-sm transition duration-150 ease-in-out text-sm flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Import
                </button>
            </form>

            <!-- Export Button -->
            <a href="{{ route('students.export') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export
            </a>

            <!-- Add Button -->
            <a href="{{ route('students.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                        <th class="py-4 px-6 font-semibold">NIS</th>
                        <th class="py-4 px-6 font-semibold">Name</th>
                        <th class="py-4 px-6 font-semibold">Grade</th>
                        <th class="py-4 px-6 font-semibold">Major</th>
                        <th class="py-4 px-6 font-semibold">Gender</th>
                        <th class="py-4 px-6 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-4 px-6 text-gray-800 font-medium">{{ $student->student_number }}</td>
                            <td class="py-4 px-6 text-gray-600 font-medium">{{ $student->user->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md text-xs font-medium">
                                    {{ $student->grade }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-md text-xs font-medium">
                                    {{ $student->major }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-600 capitalize">{{ $student->gender }}</td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('students.edit', $student->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 px-6 text-center text-gray-500">
                                No students found. Click "Add Student" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($students->hasPages())
            <div class="p-4 border-t border-gray-100">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

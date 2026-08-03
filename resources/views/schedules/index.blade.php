@extends('layouts.app')

@section('header_title', 'Schedules Management')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">All Schedules</h3>
        <a href="{{ route('schedules.create') }}" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
            + Add Schedule
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Class Name</th>
                    <th class="px-6 py-4 font-semibold">Day</th>
                    <th class="px-6 py-4 font-semibold">Period</th>
                    <th class="px-6 py-4 font-semibold">Subject</th>
                    <th class="px-6 py-4 font-semibold">Teacher</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($schedules as $schedule)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $schedule->class_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->day }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->period }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->subject->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->teacher->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm text-right space-x-2">
                        <a href="{{ route('schedules.edit', $schedule) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">No schedules found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

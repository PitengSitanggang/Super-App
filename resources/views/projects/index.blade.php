@extends('layouts.app')
@section('header_title', 'Manage Projects')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Project Timeline</h1>
        <a href="{{ route('projects.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create Project
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                        <th class="py-4 px-6 font-semibold">Project Name</th>
                        <th class="py-4 px-6 font-semibold">PIC Teacher</th>
                        <th class="py-4 px-6 font-semibold">Start Date</th>
                        <th class="py-4 px-6 font-semibold">End Date</th>
                        <th class="py-4 px-6 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($projects as $project)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 text-gray-800 font-medium">{{ $project->name }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $project->teacher->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $project->start_date->format('d M Y') }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $project->end_date ? $project->end_date->format('d M Y') : '-' }}</td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('projects.show', $project->id) }}" class="text-green-600 hover:text-green-800 font-medium text-sm transition">Kanban Board</a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">Edit</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this project?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-8 px-6 text-center text-gray-500">No projects found. Click "Create Project" to start one.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($projects->hasPages())
            <div class="p-4 border-t border-gray-100">{{ $projects->links() }}</div>
        @endif
    </div>
</div>
@endsection

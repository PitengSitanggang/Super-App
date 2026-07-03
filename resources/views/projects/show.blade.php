@extends('layouts.app')
@section('header_title', 'Project Board')
@section('content')
<div class="max-w-7xl mx-auto w-full">
    <!-- Project Details Header -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $project->name }}</h1>
            <p class="text-gray-600 mb-4">{{ $project->description ?? 'No description provided.' }}</p>
            <div class="flex gap-4 text-sm text-gray-500">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    PIC: <span class="font-semibold">{{ $project->teacher->name ?? 'Unassigned' }}</span>
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $project->start_date->format('d M Y') }} - {{ $project->end_date ? $project->end_date->format('d M Y') : 'Ongoing' }}
                </span>
            </div>
        </div>
        <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-gray-700 font-medium transition flex items-center gap-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Projects
        </a>
    </div>

    <!-- Kanban Board -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
        
        <!-- PENDING COLUMN -->
        <div class="bg-gray-100 rounded-xl p-4 shadow-sm border border-gray-200 min-h-[500px]">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-300">
                <h3 class="font-bold text-gray-700 uppercase text-sm tracking-wider">Pending</h3>
                <span class="bg-gray-200 text-gray-600 text-xs py-1 px-2 rounded-full font-bold">{{ $tasks['pending']->count() }}</span>
            </div>
            
            <!-- Add Task Form -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Add New Task</h4>
                <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="pending">
                    <input type="text" name="name" placeholder="Task title..." required class="w-full text-sm px-3 py-2 border border-gray-200 rounded mb-2 focus:ring-1 focus:ring-blue-500 outline-none">
                    <textarea name="description" placeholder="Description (optional)..." rows="2" class="w-full text-sm px-3 py-2 border border-gray-200 rounded mb-2 focus:ring-1 focus:ring-blue-500 outline-none"></textarea>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-2 rounded transition">Create Task</button>
                </form>
            </div>

            <!-- Task Cards -->
            <div class="space-y-3">
                @forelse($tasks['pending'] as $task)
                    @include('projects.partials.task-card', ['task' => $task, 'bgColor' => 'border-l-blue-500'])
                @empty
                    <p class="text-xs text-gray-500 text-center italic mt-4">No pending tasks.</p>
                @endforelse
            </div>
        </div>

        <!-- IN PROGRESS COLUMN -->
        <div class="bg-blue-50 rounded-xl p-4 shadow-sm border border-blue-100 min-h-[500px]">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-blue-200">
                <h3 class="font-bold text-blue-700 uppercase text-sm tracking-wider">In Progress</h3>
                <span class="bg-blue-200 text-blue-800 text-xs py-1 px-2 rounded-full font-bold">{{ $tasks['in_progress']->count() }}</span>
            </div>
            <div class="space-y-3">
                @forelse($tasks['in_progress'] as $task)
                    @include('projects.partials.task-card', ['task' => $task, 'bgColor' => 'border-l-yellow-400'])
                @empty
                    <p class="text-xs text-blue-400 text-center italic mt-4">No tasks in progress.</p>
                @endforelse
            </div>
        </div>

        <!-- COMPLETED COLUMN -->
        <div class="bg-green-50 rounded-xl p-4 shadow-sm border border-green-100 min-h-[500px]">
            <div class="flex items-center justify-between mb-4 pb-2 border-b border-green-200">
                <h3 class="font-bold text-green-700 uppercase text-sm tracking-wider">Completed</h3>
                <span class="bg-green-200 text-green-800 text-xs py-1 px-2 rounded-full font-bold">{{ $tasks['completed']->count() }}</span>
            </div>
            <div class="space-y-3">
                @forelse($tasks['completed'] as $task)
                    @include('projects.partials.task-card', ['task' => $task, 'bgColor' => 'border-l-green-500'])
                @empty
                    <p class="text-xs text-green-500 text-center italic mt-4">No completed tasks yet.</p>
                @endforelse
            </div>
        </div>
        
    </div>
</div>
@endsection

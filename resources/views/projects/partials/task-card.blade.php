<div class="bg-white p-4 rounded-lg shadow-sm border-l-4 {{ $bgColor }} hover:shadow-md transition group relative">
    <div class="flex justify-between items-start mb-2">
        <h5 class="font-semibold text-gray-800 text-sm leading-tight">{{ $task->name }}</h5>
        <!-- Delete Button (shown on hover) -->
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition shrink-0" onsubmit="return confirm('Are you sure you want to delete this task?');">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-400 hover:text-red-600 transition ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </form>
    </div>
    
    @if($task->description)
        <p class="text-xs text-gray-500 mb-3">{{ \Illuminate\Support\Str::limit($task->description, 80) }}</p>
    @endif

    <div class="mt-3 pt-3 border-t border-gray-50">
        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="flex gap-2 items-center">
            @csrf @method('PATCH')
            <select name="status" class="text-xs w-full border border-gray-200 rounded p-1 text-gray-600 outline-none focus:border-blue-400 bg-gray-50 cursor-pointer">
                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="bg-gray-800 text-white text-[10px] uppercase font-bold px-2 py-1.5 rounded hover:bg-gray-700 transition shrink-0">Move</button>
        </form>
    </div>
    <div class="text-[10px] text-gray-400 text-right mt-2">
        Added {{ $task->created_at->diffForHumans() }}
    </div>
</div>

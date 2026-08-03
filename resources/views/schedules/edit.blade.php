@extends('layouts.app')

@section('header_title', 'Edit Schedule')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ route('schedules.update', $schedule) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Class Name</label>
            <input type="text" name="class_name" value="{{ old('class_name', $schedule->class_name) }}" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring-primary px-4 py-3 bg-gray-50/50">
            @error('class_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Day</label>
                <select name="day" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring-primary px-4 py-3 bg-gray-50/50">
                    <option value="">Select Day</option>
                    @foreach($days as $day)
                        <option value="{{ $day }}" {{ old('day', $schedule->day) == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
                @error('day') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Period (1-7)</label>
                <div class="flex flex-wrap gap-4 mt-2">
                    @for($i = 1; $i <= 7; $i++)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="period[]" value="{{ $i }}" class="rounded border-gray-300 text-primary focus:ring-primary h-5 w-5" {{ in_array($i, old('period', [$schedule->period])) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Period {{ $i }}</span>
                        </label>
                    @endfor
                </div>
                @error('period') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                <select name="subject_id" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring-primary px-4 py-3 bg-gray-50/50">
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id', $schedule->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Teacher</label>
                <select name="teacher_id" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary focus:ring-primary px-4 py-3 bg-gray-50/50">
                    <option value="">Select Teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id', $schedule->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacher_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pt-4 flex items-center space-x-4">
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-xl font-medium hover:bg-indigo-700 transition-colors shadow-sm w-full sm:w-auto">
                Update Schedule
            </button>
            <a href="{{ route('schedules.index') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-3">Cancel</a>
        </div>
    </form>
</div>
@endsection

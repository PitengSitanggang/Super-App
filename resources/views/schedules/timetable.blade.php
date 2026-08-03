@extends('layouts.app')

@section('header_title', 'Class Timetables')

@section('content')
<div class="space-y-12">
    @forelse($groupedSchedules as $className => $classSchedules)
    <div class="bg-amber-100/50 p-6 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border-4 border-amber-200/50 relative overflow-hidden">
        <!-- Pin decoration -->
        <div class="absolute top-4 left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-red-400 shadow-md border border-red-500 z-10">
            <div class="absolute inset-2 rounded-full bg-red-300 shadow-inner"></div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-4">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-black text-gray-800 uppercase tracking-widest font-sans border-b-2 border-primary/20 inline-block pb-2">Class: {{ $className }}</h3>
            </div>

            <div class="grid grid-cols-9 gap-3">
                <!-- Header Row -->
                <div class="bg-primary text-white font-bold text-center py-3 rounded-xl shadow-sm flex items-center justify-center">Day</div>
                @for($i = 1; $i <= 4; $i++)
                    <div class="bg-primary/90 text-white font-bold text-center py-3 rounded-xl shadow-sm flex items-center justify-center">Period {{ $i }}</div>
                @endfor
                
                <div class="bg-rose-500 text-white font-bold text-center py-3 rounded-xl shadow-sm flex items-center justify-center uppercase tracking-widest text-xs row-span-6 relative overflow-hidden">
                    <span class="rotate-180" style="writing-mode: vertical-rl;">BREAK</span>
                </div>

                @for($i = 5; $i <= 7; $i++)
                    <div class="bg-primary/90 text-white font-bold text-center py-3 rounded-xl shadow-sm flex items-center justify-center">Period {{ $i }}</div>
                @endfor

                <!-- Data Rows -->
                @foreach($days as $day)
                    <!-- Day Column -->
                    <div class="bg-indigo-50 text-primary font-bold text-center py-4 rounded-xl shadow-sm border border-indigo-100 flex items-center justify-center h-full min-h-[80px]">
                        {{ $day }}
                    </div>

                    <!-- Periods 1-4 -->
                    @for($i = 1; $i <= 4; $i++)
                        @php
                            $schedule = $classSchedules[$day][$i] ?? null;
                        @endphp
                        <div class="bg-white rounded-xl border-2 {{ $schedule ? 'border-green-200 hover:border-green-400 bg-green-50/30' : 'border-dashed border-gray-200 bg-gray-50/50' }} p-3 transition-colors flex flex-col justify-center text-center shadow-sm relative group overflow-hidden">
                            @if($schedule)
                                <div class="font-bold text-gray-800 text-sm leading-tight mb-1">{{ $schedule->subject->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500 font-medium truncate">{{ $schedule->teacher->name ?? 'N/A' }}</div>
                                <div class="absolute -right-6 -top-6 w-12 h-12 bg-green-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                            @else
                                <span class="text-gray-300 text-sm font-medium">-</span>
                            @endif
                        </div>
                    @endfor

                    <!-- Periods 5-7 -->
                    @for($i = 5; $i <= 7; $i++)
                        @php
                            $schedule = $classSchedules[$day][$i] ?? null;
                        @endphp
                        <div class="bg-white rounded-xl border-2 {{ $schedule ? 'border-blue-200 hover:border-blue-400 bg-blue-50/30' : 'border-dashed border-gray-200 bg-gray-50/50' }} p-3 transition-colors flex flex-col justify-center text-center shadow-sm relative group overflow-hidden">
                            @if($schedule)
                                <div class="font-bold text-gray-800 text-sm leading-tight mb-1">{{ $schedule->subject->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500 font-medium truncate">{{ $schedule->teacher->name ?? 'N/A' }}</div>
                                <div class="absolute -right-6 -top-6 w-12 h-12 bg-blue-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                            @else
                                <span class="text-gray-300 text-sm font-medium">-</span>
                            @endif
                        </div>
                    @endfor
                @endforeach
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Timetables Available</h3>
        <p class="text-gray-500">There are currently no class schedules to display.</p>
    </div>
    @endforelse
</div>
@endsection

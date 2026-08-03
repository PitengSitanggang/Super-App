<aside id="sidebar" class="w-64 shrink-0 bg-dark text-white flex flex-col shadow-2xl relative z-20 transition-all duration-300 ease-in-out">
    @php
        $appName = \App\Models\Setting::where('key', 'app_name')->value('value') ?? config('app.name');
        $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value');
    @endphp
    <div class="h-20 flex items-center px-8 border-b border-gray-800">
        @if($appLogo)
            <img src="{{ asset('storage/' . $appLogo) }}" alt="Logo" class="w-8 h-8 object-contain mr-3">
        @else
            <div class="w-8 h-8 bg-gradient-to-tr from-primary to-purple-500 rounded-lg flex items-center justify-center mr-3 font-bold text-lg shadow-lg">
                {{ substr($appName, 0, 1) }}
            </div>
        @endif
        <h1 class="text-xl font-bold tracking-wider truncate">{{ $appName }}</h1>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('visualisasi-data') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('visualisasi-data') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
            <span class="font-medium">Visualisasi Data</span>
        </a>

        <a href="{{ route('settings.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('settings.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span class="font-medium">Settings</span>
        </a>

        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>

        <a href="{{ route('teachers.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('teachers.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="font-medium">Teachers</span>
        </a>

        <a href="{{ route('students.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('students.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="font-medium">Students</span>
        </a>

        <a href="{{ route('subjects.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('subjects.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-purple-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <span class="font-medium">Subjects</span>
        </a>

        <a href="{{ route('schedules.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('schedules.index', 'schedules.create', 'schedules.edit') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-orange-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="font-medium">Schedules</span>
        </a>

        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Tools</p>

        <a href="{{ route('agendas.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('agendas.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="font-medium">Agenda Sekolah</span>
        </a>

        <a href="{{ route('projects.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('projects.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-green-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <span class="font-medium">Project Timeline</span>
        </a>

        <a href="{{ route('lesson-plans.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('lesson-plans.*') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <span class="font-medium">Lesson Plans</span>
        </a>

        <a href="{{ route('schedules.timetable') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-300 hover:text-white hover:bg-white/5 transition-all duration-200 group {{ request()->routeIs('schedules.timetable') ? 'bg-white/10 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3 group-hover:text-pink-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            <span class="font-medium">Class Timetables</span>
        </a>
    </nav>

</aside>

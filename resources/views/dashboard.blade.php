@extends('layouts.app')
@section('header_title', 'Overview Dashboard')
@section('content')
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h3 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight">Welcome back, Admin 👋</h3>
            <p class="text-gray-500 mt-2 text-lg font-medium">Here is what's happening across your educational platform today.</p>
        </div>
        <div class="flex space-x-3">
            <button class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl font-semibold shadow-sm hover:bg-gray-50 hover:border-gray-300 transition-all">Report</button>
            <button class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-300 transition-all">Quick Action</button>
        </div>
    </div>

    <!-- Dashboard Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">

        <!-- Teachers Card -->
        <a href="{{ route('teachers.index') }}" class="group block h-full outline-none">
            <div class="relative bg-white/70 backdrop-blur-2xl border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-8 h-full hover:bg-white transition-all duration-500 overflow-hidden hover:shadow-[0_8px_30px_rgb(79,70,229,0.1)] hover:-translate-y-1">
                <!-- Decorative Blur -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-500/30 transform group-hover:-translate-y-2 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 text-xs font-bold uppercase tracking-wider rounded-full border border-indigo-100 group-hover:bg-indigo-100 transition-colors">
                            Staff
                        </span>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-indigo-600 transition-colors">Teacher Mgt.</h3>
                        <p class="text-gray-500 leading-relaxed font-medium">
                            Kelola data profil guru, jadwal mengajar, absensi, dan penugasan akademik.
                        </p>
                    </div>

                    <div class="mt-8 flex items-center text-indigo-600 font-bold group-hover:text-indigo-700">
                        <span class="mr-3">Buka Aplikasi</span>
                        <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 group-hover:translate-x-2 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Students Card -->
        <a href="{{ route('students.index') }}" class="group block h-full outline-none">
            <div class="relative bg-white/70 backdrop-blur-2xl border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-8 h-full hover:bg-white transition-all duration-500 overflow-hidden hover:shadow-[0_8px_30px_rgb(59,130,246,0.1)] hover:-translate-y-1">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30 transform group-hover:-translate-y-2 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider rounded-full border border-blue-100 group-hover:bg-blue-100 transition-colors">
                            Academic
                        </span>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">Student Mgt.</h3>
                        <p class="text-gray-500 leading-relaxed font-medium">
                            Kelola data siswa, pendaftaran, riwayat akademik, dan informasi administratif.
                        </p>
                    </div>

                    <div class="mt-8 flex items-center text-blue-600 font-bold group-hover:text-blue-700">
                        <span class="mr-3">Buka Aplikasi</span>
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 group-hover:translate-x-2 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Subjects Card -->
        <a href="{{ route('subjects.index') }}" class="group block h-full outline-none">
            <div class="relative bg-white/70 backdrop-blur-2xl border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-8 h-full hover:bg-white transition-all duration-500 overflow-hidden hover:shadow-[0_8px_30px_rgb(168,85,247,0.1)] hover:-translate-y-1">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 text-white flex items-center justify-center shadow-lg shadow-purple-500/30 transform group-hover:-translate-y-2 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="px-4 py-1.5 bg-purple-50 text-purple-600 text-xs font-bold uppercase tracking-wider rounded-full border border-purple-100 group-hover:bg-purple-100 transition-colors">
                            Curriculum
                        </span>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors">Subject Mgt.</h3>
                        <p class="text-gray-500 leading-relaxed font-medium">
                            Atur daftar mata pelajaran, kurikulum, silabus, dan alokasi guru pengajar.
                        </p>
                    </div>

                    <div class="mt-8 flex items-center text-purple-600 font-bold group-hover:text-purple-700">
                        <span class="mr-3">Buka Aplikasi</span>
                        <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 group-hover:translate-x-2 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Projects Card -->
        <a href="{{ route('projects.index') }}" class="group block h-full outline-none">
            <div class="relative bg-white/70 backdrop-blur-2xl border border-white/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-8 h-full hover:bg-white transition-all duration-500 overflow-hidden hover:shadow-[0_8px_30px_rgb(16,185,129,0.1)] hover:-translate-y-1">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30 transform group-hover:-translate-y-2 group-hover:scale-110 transition-all duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-xs font-bold uppercase tracking-wider rounded-full border border-emerald-100 group-hover:bg-emerald-100 transition-colors">
                            Activity
                        </span>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">Project Mgt.</h3>
                        <p class="text-gray-500 leading-relaxed font-medium">
                            Pantau aktivitas proyek, jadwal kegiatan sekolah, dan kolaborasi.
                        </p>
                    </div>

                    <div class="mt-8 flex items-center text-emerald-600 font-bold group-hover:text-emerald-700">
                        <span class="mr-3">Buka Aplikasi</span>
                        <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 group-hover:translate-x-2 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </div>
@endsection
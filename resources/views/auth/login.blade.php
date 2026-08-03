<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Super App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: { 50: '#eef2ff', 500: '#6366f1', 600: '#4f46e5' }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }
        .dark .glass-panel {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen relative overflow-hidden transition-colors duration-500 flex items-center justify-center">
    
    <!-- Animated Background Blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[0%] left-[10%] w-[500px] h-[500px] bg-brand-500/20 dark:bg-brand-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] right-[10%] w-[400px] h-[400px] bg-teal-500/20 dark:bg-teal-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70 animate-blob" style="animation-delay: 2s"></div>
        <div class="absolute bottom-[-10%] left-[30%] w-[600px] h-[600px] bg-purple-500/20 dark:bg-purple-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70 animate-blob" style="animation-delay: 4s"></div>
    </div>

    <!-- Floating Theme Toggle -->
    <button id="themeToggle" class="fixed top-6 right-6 z-50 inline-flex items-center justify-center w-12 h-12 rounded-full bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all hover:scale-110 focus:outline-none shadow-lg border border-slate-200 dark:border-slate-700">
        <!-- Sun Icon -->
        <svg id="themeToggleLightIcon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
        </svg>
        <!-- Moon Icon -->
        <svg id="themeToggleDarkIcon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
    </button>

    <div class="w-full max-w-md w-full relative z-10 px-6">
        <div class="glass-panel p-10 rounded-[2rem]">
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-gradient-to-br from-brand-500 to-indigo-600 rounded-[1.25rem] mx-auto flex items-center justify-center mb-6 transform -rotate-6 shadow-xl shadow-brand-500/30">
                    <svg class="w-10 h-10 text-white transform rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Welcome Back</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">Please sign in to access your dashboard.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all backdrop-blur-sm" placeholder="name@example.com">
                    @error('email')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all backdrop-blur-sm" placeholder="••••••••">
                    @error('password')<p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-500 text-white font-bold py-4 px-6 rounded-2xl shadow-xl shadow-brand-500/30 transition-all duration-300 transform hover:-translate-y-1">
                    Sign In to Account
                </button>
            </form>

            <div class="mt-10 text-center text-sm font-medium text-slate-400 dark:text-slate-500 space-y-1">
                <p class="uppercase tracking-widest text-xs mb-3">Demo Accounts</p>
                <div class="flex justify-between items-center bg-slate-100 dark:bg-slate-800/50 p-3 rounded-xl">
                    <span class="text-slate-600 dark:text-slate-300">superadmin@superapp.com</span>
                    <span class="text-slate-400">password</span>
                </div>
                <div class="flex justify-between items-center bg-slate-100 dark:bg-slate-800/50 p-3 rounded-xl">
                    <span class="text-slate-600 dark:text-slate-300">guru1@superapp.com</span>
                    <span class="text-slate-400">password</span>
                </div>
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ route('public.dashboard') }}" class="text-brand-500 hover:text-brand-600 dark:hover:text-brand-400 font-semibold text-sm transition-colors">
                    &larr; View Public Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('themeToggle');
            const darkIcon = document.getElementById('themeToggleDarkIcon');
            const lightIcon = document.getElementById('themeToggleLightIcon');

            function updateIcons() {
                if (document.documentElement.classList.contains('dark')) {
                    darkIcon.classList.add('hidden');
                    lightIcon.classList.remove('hidden');
                } else {
                    lightIcon.classList.add('hidden');
                    darkIcon.classList.remove('hidden');
                }
            }
            
            updateIcons();

            themeToggleBtn.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
                updateIcons();
            });
        });
    </script>
</body>
</html>

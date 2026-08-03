<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Dashboard - Kiosk Display</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased min-h-screen relative overflow-x-hidden transition-colors duration-500 pt-16 pb-12">
    
    <!-- Animated Background Blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-brand-500/20 dark:bg-brand-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-[20%] right-[-10%] w-[400px] h-[400px] bg-teal-500/20 dark:bg-teal-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70 animate-blob" style="animation-delay: 2s"></div>
        <div class="absolute bottom-[-20%] left-[30%] w-[600px] h-[600px] bg-purple-500/20 dark:bg-purple-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-3xl opacity-70 animate-blob" style="animation-delay: 4s"></div>
    </div>

    <!-- Floating Theme Toggle -->
    <button id="themeToggle" class="fixed top-6 right-6 z-50 inline-flex items-center justify-center w-14 h-14 rounded-full bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all hover:scale-110 hover:rotate-12 focus:outline-none shadow-xl border border-slate-200 dark:border-slate-700">
        <!-- Sun Icon -->
        <svg id="themeToggleLightIcon" class="w-7 h-7 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
        </svg>
        <!-- Moon Icon -->
        <svg id="themeToggleDarkIcon" class="w-7 h-7 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
    </button>

    <main class="max-w-[1400px] mx-auto px-6 relative z-10">
        
        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-panel rounded-[2rem] p-8 flex items-center gap-6 group hover:-translate-y-2 transition-all duration-300">
                <div class="w-20 h-20 rounded-[1.25rem] bg-gradient-to-br from-brand-500 to-indigo-600 flex items-center justify-center text-white shrink-0 shadow-lg shadow-brand-500/30 group-hover:scale-110 transition-transform">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Teachers</p>
                    <h3 class="text-5xl font-black text-slate-800 dark:text-white tracking-tight">{{ number_format($totalTeachers) }}</h3>
                </div>
            </div>

            <div class="glass-panel rounded-[2rem] p-8 flex items-center gap-6 group hover:-translate-y-2 transition-all duration-300">
                <div class="w-20 h-20 rounded-[1.25rem] bg-gradient-to-br from-sky-400 to-blue-600 flex items-center justify-center text-white shrink-0 shadow-lg shadow-sky-500/30 group-hover:scale-110 transition-transform">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Students</p>
                    <h3 class="text-5xl font-black text-slate-800 dark:text-white tracking-tight">{{ number_format($totalStudents) }}</h3>
                </div>
            </div>

            <div class="glass-panel rounded-[2rem] p-8 flex items-center gap-6 group hover:-translate-y-2 transition-all duration-300">
                <div class="w-20 h-20 rounded-[1.25rem] bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center text-white shrink-0 shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Subjects</p>
                    <h3 class="text-5xl font-black text-slate-800 dark:text-white tracking-tight">{{ number_format($totalSubjects) }}</h3>
                </div>
            </div>
        </div>

        <!-- Bento Grid Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            
            <!-- Chart 1: Teachers vs Students (Square - Pie) -->
            <div class="glass-panel p-8 rounded-[2rem] flex flex-col group relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Population</h3>
                    <div class="w-10 h-10 bg-brand-50 dark:bg-brand-500/20 rounded-xl flex items-center justify-center text-brand-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                    </div>
                </div>
                <div class="relative w-full h-[280px] flex-grow">
                    <canvas id="chart1"></canvas>
                </div>
            </div>

            <!-- Chart 2: Schedules per Day (Wide - Bar) -->
            <div class="glass-panel p-8 rounded-[2rem] flex flex-col md:col-span-1 xl:col-span-2 group relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Weekly Schedules Volume</h3>
                    <div class="w-10 h-10 bg-teal-50 dark:bg-teal-500/20 rounded-xl flex items-center justify-center text-teal-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div class="relative w-full h-[280px] flex-grow">
                    <canvas id="chart2"></canvas>
                </div>
            </div>

            <!-- Chart 3: Users by Role (Square - Polar Area) -->
            <div class="glass-panel p-8 rounded-[2rem] flex flex-col group relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Role Demographics</h3>
                    <div class="w-10 h-10 bg-amber-50 dark:bg-amber-500/20 rounded-xl flex items-center justify-center text-amber-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="relative w-full h-[280px] flex-grow">
                    <canvas id="chart4"></canvas>
                </div>
            </div>

            <!-- Chart 4: Projects Status (Square - Doughnut) -->
            <div class="glass-panel p-8 rounded-[2rem] flex flex-col group relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Project Milestones</h3>
                    <div class="w-10 h-10 bg-pink-50 dark:bg-pink-500/20 rounded-xl flex items-center justify-center text-pink-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
                <div class="relative w-full h-[280px] flex-grow">
                    <canvas id="chart3"></canvas>
                </div>
            </div>

            <!-- Chart 5: Tasks by Status (Square - Radar) -->
            <div class="glass-panel p-8 rounded-[2rem] flex flex-col group relative">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-white">Task Distribution</h3>
                    <div class="w-10 h-10 bg-violet-50 dark:bg-violet-500/20 rounded-xl flex items-center justify-center text-violet-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
                <div class="relative w-full h-[280px] flex-grow">
                    <canvas id="chart5"></canvas>
                </div>
            </div>
            
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Theme Toggle Logic
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

            const charts = [];

            themeToggleBtn.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
                updateIcons();
                updateChartThemes();
            });

            function getChartColors() {
                const isDark = document.documentElement.classList.contains('dark');
                return {
                    text: isDark ? '#cbd5e1' : '#64748b',
                    grid: isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.04)',
                    tooltipBg: isDark ? 'rgba(15, 23, 42, 0.9)' : 'rgba(255, 255, 255, 0.95)',
                    tooltipText: isDark ? '#f8fafc' : '#0f172a'
                };
            }

            function updateChartThemes() {
                const colors = getChartColors();
                charts.forEach(chart => {
                    if(chart.options.plugins.legend) {
                        chart.options.plugins.legend.labels.color = colors.text;
                    }
                    if(chart.options.plugins.tooltip) {
                        chart.options.plugins.tooltip.backgroundColor = colors.tooltipBg;
                        chart.options.plugins.tooltip.titleColor = colors.tooltipText;
                        chart.options.plugins.tooltip.bodyColor = colors.tooltipText;
                    }
                    if(chart.options.scales) {
                        if(chart.options.scales.x) {
                            chart.options.scales.x.ticks.color = colors.text;
                            if(chart.options.scales.x.grid) chart.options.scales.x.grid.color = colors.grid;
                        }
                        if(chart.options.scales.y) {
                            chart.options.scales.y.ticks.color = colors.text;
                            if(chart.options.scales.y.grid) chart.options.scales.y.grid.color = colors.grid;
                        }
                        if(chart.options.scales.r) {
                            chart.options.scales.r.grid.color = colors.grid;
                            chart.options.scales.r.angleLines.color = colors.grid;
                            chart.options.scales.r.pointLabels.color = colors.text;
                            if(chart.options.scales.r.ticks) {
                                chart.options.scales.r.ticks.backdropColor = 'transparent';
                                chart.options.scales.r.ticks.color = colors.text;
                            }
                        }
                    }
                    chart.update();
                });
            }

            Chart.defaults.font.family = "'Outfit', sans-serif";
            const initColors = getChartColors();
            Chart.defaults.color = initColors.text;
            Chart.defaults.plugins.tooltip.padding = 12;
            Chart.defaults.plugins.tooltip.cornerRadius = 12;
            Chart.defaults.plugins.tooltip.backgroundColor = initColors.tooltipBg;
            Chart.defaults.plugins.tooltip.titleColor = initColors.tooltipText;
            Chart.defaults.plugins.tooltip.bodyColor = initColors.tooltipText;
            Chart.defaults.plugins.tooltip.borderColor = initColors.grid;
            Chart.defaults.plugins.tooltip.borderWidth = 1;

            // Chart 1: Teachers vs Students (Pie)
            charts.push(new Chart(document.getElementById('chart1'), {
                type: 'pie',
                data: {
                    labels: {!! $chart1Labels !!},
                    datasets: [{
                        data: {!! $chart1Data !!},
                        backgroundColor: ['#6366f1', '#0ea5e9'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: { padding: 10 },
                    plugins: { legend: { position: 'bottom', labels: { padding: 20, font: { size: 13, weight: '500' }, usePointStyle: true, color: initColors.text } } }
                }
            }));

            // Chart 2: Schedules per Day (Bar)
            charts.push(new Chart(document.getElementById('chart2'), {
                type: 'bar',
                data: {
                    labels: {!! $chart2Labels !!},
                    datasets: [{
                        label: 'Schedules',
                        data: {!! $chart2Data !!},
                        backgroundColor: ['#14b8a6', '#0ea5e9', '#6366f1', '#d946ef', '#f43f5e'],
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: initColors.grid, drawBorder: false }, ticks: { color: initColors.text, padding: 10 } },
                        x: { grid: { display: false }, ticks: { color: initColors.text } }
                    }
                }
            }));

            // Chart 3: Projects Status (Doughnut)
            charts.push(new Chart(document.getElementById('chart3'), {
                type: 'doughnut',
                data: {
                    labels: {!! $chart3Labels !!},
                    datasets: [{
                        data: {!! $chart3Data !!},
                        backgroundColor: ['#10b981', '#f43f5e'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    layout: { padding: 10 },
                    plugins: { legend: { position: 'bottom', labels: { padding: 20, font: { size: 13, weight: '500' }, usePointStyle: true, color: initColors.text } } }
                }
            }));

            // Chart 4: Users by Role (Polar Area)
            charts.push(new Chart(document.getElementById('chart4'), {
                type: 'polarArea',
                data: {
                    labels: {!! $chart4Labels !!}.map(l => l.charAt(0).toUpperCase() + l.slice(1)),
                    datasets: [{
                        data: {!! $chart4Data !!},
                        backgroundColor: ['rgba(245, 158, 11, 0.7)', 'rgba(139, 92, 246, 0.7)', 'rgba(16, 185, 129, 0.7)'],
                        borderColor: ['#f59e0b', '#8b5cf6', '#10b981'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: { padding: 10 },
                    scales: {
                        r: {
                            grid: { color: initColors.grid },
                            angleLines: { color: initColors.grid },
                            pointLabels: { color: initColors.text },
                            ticks: { backdropColor: 'transparent', color: initColors.text, display: false }
                        }
                    },
                    plugins: { legend: { position: 'bottom', labels: { padding: 20, font: { size: 13, weight: '500' }, usePointStyle: true, color: initColors.text } } }
                }
            }));

            // Chart 5: Tasks by Status (Horizontal Bar)
            charts.push(new Chart(document.getElementById('chart5'), {
                type: 'bar',
                data: {
                    labels: {!! $chart5Labels !!}.map(l => l.charAt(0).toUpperCase() + l.slice(1).replace('_', ' ')),
                    datasets: [{
                        label: 'Tasks',
                        data: {!! $chart5Data !!},
                        backgroundColor: ['#a855f7', '#ec4899', '#f97316', '#84cc16'],
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { beginAtZero: true, grid: { color: initColors.grid, drawBorder: false }, ticks: { color: initColors.text, padding: 10 } },
                        y: { grid: { display: false }, ticks: { color: initColors.text } }
                    }
                }
            }));

        });
    </script>
</body>
</html>

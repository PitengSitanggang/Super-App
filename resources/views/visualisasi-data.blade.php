@extends('layouts.app')
@section('header_title', 'Visualisasi Data')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="bg-[#1e1e2d] text-white p-6 rounded-[2rem] shadow-2xl min-h-[800px] overflow-hidden relative">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative z-10">
        <h2 class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-500 mb-8 tracking-wide">Dashboard Visualisasi Data Penjualan</h2>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Penjualan -->
            <div class="bg-gradient-to-br from-cyan-400 to-blue-600 rounded-2xl p-5 flex flex-col justify-between shadow-lg shadow-blue-500/20 transform hover:-translate-y-1 transition-transform">
                <span class="text-sm font-semibold text-white/90 uppercase tracking-wider">Total Penjualan</span>
                <div class="flex items-center mt-3">
                    <svg class="w-10 h-10 text-white/80 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-3xl font-extrabold text-white">Rp647.564.450</span>
                </div>
            </div>
            <!-- Total Profit -->
            <div class="bg-gradient-to-br from-lime-400 to-green-600 rounded-2xl p-5 flex flex-col justify-between shadow-lg shadow-green-500/20 transform hover:-translate-y-1 transition-transform">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-semibold text-white/90 uppercase tracking-wider">Total Profit</span>
                    <span class="text-xs font-bold bg-white/30 px-3 py-1 rounded-full text-white">23%</span>
                </div>
                <div class="flex items-center mt-3">
                    <svg class="w-10 h-10 text-white/80 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-3xl font-extrabold text-white">Rp122.851.425</span>
                </div>
            </div>
            <!-- Total Produk -->
            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl p-5 flex flex-col justify-between shadow-lg shadow-orange-500/20 transform hover:-translate-y-1 transition-transform">
                <span class="text-sm font-semibold text-white/90 uppercase tracking-wider">Total Produk Terjual</span>
                <div class="flex items-center mt-3 text-white">
                    <svg class="w-10 h-10 text-white/80 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span class="text-3xl font-extrabold">54.827 <span class="text-base font-medium opacity-80">Pcs</span></span>
                </div>
            </div>
            <!-- Produk Terlaris -->
            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-5 flex flex-col justify-between shadow-lg shadow-purple-500/20 transform hover:-translate-y-1 transition-transform">
                <span class="text-sm font-semibold text-white/90 uppercase tracking-wider">Produk Terlaris</span>
                <div class="flex items-center mt-3">
                    <svg class="w-10 h-10 text-white/80 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    <div class="text-white">
                        <span class="text-3xl font-extrabold block leading-none">6.417</span>
                        <span class="text-sm font-medium opacity-80">Yoyic Blueberry</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Jenis Penjualan -->
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl">
                <h3 class="text-gray-300 font-semibold mb-4 flex items-center"><svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> Jenis Penjualan</h3>
                <div id="chart-jenis"></div>
            </div>
            <!-- Bulanan -->
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl lg:col-span-1">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-gray-300 font-semibold flex items-center"><svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Bulanan</h3>
                </div>
                <div id="chart-bulanan"></div>
            </div>
            <!-- 5 Produk Terlaris -->
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl">
                <h3 class="text-gray-300 font-semibold mb-4 flex items-center"><svg class="w-5 h-5 mr-2 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg> 5 Produk Terlaris</h3>
                <div id="chart-terlaris"></div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl">
                <h3 class="text-gray-300 font-semibold mb-4 flex items-center text-sm"><svg class="w-4 h-4 mr-2 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> Penjualan / Kategori</h3>
                <div id="chart-kategori"></div>
            </div>
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl">
                <h3 class="text-gray-300 font-semibold mb-4 flex items-center text-sm"><svg class="w-4 h-4 mr-2 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Penjualan / Tahun</h3>
                <div id="chart-tahun"></div>
            </div>
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl">
                <h3 class="text-gray-300 font-semibold mb-4 flex items-center text-sm"><svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> Profit / Harga Beli</h3>
                <div id="chart-profit-radial"></div>
            </div>
            <div class="bg-[#27293d]/80 backdrop-blur-md rounded-2xl p-5 border border-gray-700/50 shadow-xl">
                <h3 class="text-gray-300 font-semibold mb-4 flex items-center text-sm"><svg class="w-4 h-4 mr-2 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> Penjualan by Hari</h3>
                <div id="chart-hari"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Shared options for dark theme
        const darkOptions = {
            chart: { foreColor: '#9ca3af', toolbar: { show: false }, background: 'transparent' },
            tooltip: { theme: 'dark' },
            grid: { borderColor: '#374151', strokeDashArray: 4 }
        };

        // 1. Jenis Penjualan (Donut)
        new ApexCharts(document.querySelector("#chart-jenis"), {
            ...darkOptions,
            series: [36, 25, 39],
            chart: { type: 'donut', height: 250, background: 'transparent' },
            labels: ['Eceran', 'Grosir', 'Online'],
            colors: ['#3b82f6', '#10b981', '#ec4899'],
            plotOptions: { pie: { donut: { size: '70%' } } },
            dataLabels: { enabled: false },
            legend: { position: 'bottom', markers: { radius: 12 } },
            stroke: { show: true, colors: ['#27293d'], width: 2 }
        }).render();

        // 2. Bulanan (Area/Line)
        new ApexCharts(document.querySelector("#chart-bulanan"), {
            ...darkOptions,
            series: [{ name: 'Penjualan', data: [8.5, 7.1, 8.4, 9.8, 10.4, 10.8, 11.5, 14.6, 11.4, 12.7, 10.4, 7.1] }],
            chart: { type: 'area', height: 250, background: 'transparent' },
            colors: ['#3b82f6'],
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.5, opacityTo: 0.1, stops: [0, 90, 100] } },
            dataLabels: { enabled: true, offsetY: -5, style: { fontSize: '10px', colors: ['#fff'] }, background: { enabled: false } },
            stroke: { curve: 'smooth', width: 3 },
            xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], axisBorder: {show: false}, axisTicks: {show: false} },
            yaxis: { show: false }
        }).render();

        // 3. 5 Produk Terlaris (Bar Horizontal)
        new ApexCharts(document.querySelector("#chart-terlaris"), {
            ...darkOptions,
            series: [{ name: 'Penjualan', data: [130.9, 81.0, 52.9, 49.4, 41.6] }],
            chart: { type: 'bar', height: 250, background: 'transparent' },
            plotOptions: { bar: { horizontal: true, borderRadius: 4, distributed: true, dataLabels: { position: 'bottom' } } },
            colors: ['#fbbf24', '#f59e0b', '#d97706', '#b45309', '#92400e'],
            dataLabels: { enabled: true, textAnchor: 'start', style: { colors: ['#fff'] }, formatter: function (val, opt) { return opt.w.globals.labels[opt.dataPointIndex] + ": " + val + " Jt" }, offsetX: 0, dropShadow: { enabled: true } },
            xaxis: { show: false, labels: {show: false}, axisBorder: {show: false}, axisTicks: {show: false} },
            yaxis: { show: false, labels: {show: false} },
            grid: { show: false },
            legend: { show: false }
        }).render();

        // 4. Penjualan Kategori (Bar)
        new ApexCharts(document.querySelector("#chart-kategori"), {
            ...darkOptions,
            series: [{ name: 'Kategori', data: [154, 195, 135, 102] }],
            chart: { type: 'bar', height: 180, background: 'transparent', sparkline: { enabled: true } },
            plotOptions: { bar: { distributed: true, borderRadius: 4 } },
            colors: ['#84cc16', '#f59e0b', '#2dd4bf', '#e879f9'],
            dataLabels: { enabled: false },
            xaxis: { categories: ['Perawatan Tubuh', 'Alat Tulis', 'Minuman', 'Makanan'] },
            tooltip: { fixed: { enabled: true } }
        }).render();

        // 5. Penjualan Tahun (Bar)
        new ApexCharts(document.querySelector("#chart-tahun"), {
            ...darkOptions,
            series: [{ name: 'Tahun', data: [248, 298] }],
            chart: { type: 'bar', height: 180, background: 'transparent', sparkline: { enabled: true } },
            plotOptions: { bar: { columnWidth: '40%', borderRadius: 6, distributed: true } },
            colors: ['#a3e635', '#f97316'],
            xaxis: { categories: ['2021', '2022'] }
        }).render();

        // 6. Profit Radial
        new ApexCharts(document.querySelector("#chart-profit-radial"), {
            ...darkOptions,
            series: [23],
            chart: { type: 'radialBar', height: 180 },
            plotOptions: { radialBar: { hollow: { size: '65%' }, track: { background: '#374151' }, dataLabels: { value: { color: '#fff', fontSize: '24px', show: true, fontWeight: 'bold' } } } },
            colors: ['#84cc16'],
            labels: ['Profit'],
            stroke: { lineCap: 'round' }
        }).render();

        // 7. Penjualan Hari (Bar)
        new ApexCharts(document.querySelector("#chart-hari"), {
            ...darkOptions,
            series: [{ name: 'Penjualan', data: [89, 91, 95, 94, 84, 95, 98] }],
            chart: { type: 'bar', height: 180, background: 'transparent' },
            plotOptions: { bar: { columnWidth: '40%', borderRadius: 4 } },
            colors: ['#e879f9'],
            dataLabels: { enabled: true, position: 'top', offsetY: -20, style: { fontSize: '10px', colors: ['#fff'] }, formatter: function(val) { return val + " Jt"; } },
            xaxis: { categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], labels: { style: { fontSize: '10px' } }, axisBorder: {show: false}, axisTicks: {show: false} },
            yaxis: { show: false },
            grid: { show: false }
        }).render();
    });
</script>
@endsection

@extends('layouts.app')
@section('header_title', 'Rencana Pembelajaran')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Rencana Pembelajaran (RPP)</h1>
        <a href="{{ route('lesson-plans.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat RPP Baru
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                        @if(auth()->user() && auth()->user()->role === 'superadmin')
                            <th class="py-4 px-6 font-semibold">Guru</th>
                        @endif
                        <th class="py-4 px-6 font-semibold">Mata Pelajaran</th>
                        <th class="py-4 px-6 font-semibold">Materi Pokok</th>
                        <th class="py-4 px-6 font-semibold">Tanggal Mulai</th>
                        <th class="py-4 px-6 font-semibold">Tanggal Selesai</th>
                        <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($lessonPlans as $rpp)
                        <tr class="hover:bg-gray-50 transition">
                            @if(auth()->user() && auth()->user()->role === 'superadmin')
                                <td class="py-4 px-6 text-gray-800 font-medium">{{ $rpp->teacher->name ?? '-' }}</td>
                            @endif
                            <td class="py-4 px-6 text-gray-600">{{ $rpp->subject->name ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ \Illuminate\Support\Str::limit($rpp->materi_pokok, 50) }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $rpp->tanggal_mulai ? $rpp->tanggal_mulai->format('d M Y') : '-' }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $rpp->tanggal_selesai ? $rpp->tanggal_selesai->format('d M Y') : '-' }}</td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('lesson-plans.edit', $rpp->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">Edit</a>
                                <form action="{{ route('lesson-plans.destroy', $rpp->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus RPP ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 px-6 text-center text-gray-500">Belum ada Rencana Pembelajaran. Silakan buat baru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($lessonPlans->hasPages())
            <div class="p-4 border-t border-gray-100">{{ $lessonPlans->links() }}</div>
        @endif
    </div>
</div>
@endsection

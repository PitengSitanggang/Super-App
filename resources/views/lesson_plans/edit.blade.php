@extends('layouts.app')
@section('header_title', 'Edit RPP')
@section('content')
<div class="max-w-4xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-800">Edit Rencana Pembelajaran</h1>
        <a href="{{ route('lesson-plans.index') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('lesson-plans.update', $lessonPlan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2">Mata Pelajaran</label>
                <select name="subject_id" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="" disabled>Pilih mata pelajaran</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id', $lessonPlan->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $lessonPlan->tanggal_mulai ? $lessonPlan->tanggal_mulai->format('Y-m-d') : '') }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    @error('tanggal_mulai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $lessonPlan->tanggal_selesai ? $lessonPlan->tanggal_selesai->format('Y-m-d') : '') }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    @error('tanggal_selesai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Kompetensi Dasar</label>
                    <textarea name="kompetensi_dasar" rows="3" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('kompetensi_dasar', $lessonPlan->kompetensi_dasar) }}</textarea>
                    @error('kompetensi_dasar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Materi Pokok</label>
                    <textarea name="materi_pokok" rows="3" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('materi_pokok', $lessonPlan->materi_pokok) }}</textarea>
                    @error('materi_pokok')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Tujuan Pembelajaran</label>
                    <textarea name="tujuan_pembelajaran" rows="3" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('tujuan_pembelajaran', $lessonPlan->tujuan_pembelajaran) }}</textarea>
                    @error('tujuan_pembelajaran')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Metode Pembelajaran</label>
                    <textarea name="metode_pembelajaran" rows="2" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('metode_pembelajaran', $lessonPlan->metode_pembelajaran) }}</textarea>
                    @error('metode_pembelajaran')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Sumber Belajar</label>
                    <textarea name="sumber_belajar" rows="2" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('sumber_belajar', $lessonPlan->sumber_belajar) }}</textarea>
                    @error('sumber_belajar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Penilaian</label>
                    <textarea name="penilaian" rows="3" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('penilaian', $lessonPlan->penilaian) }}</textarea>
                    @error('penilaian')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex gap-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-sm transition">
                    Perbarui RPP
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

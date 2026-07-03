<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Security scoping will be checked in Controller/Service
        return true;
    }

    public function rules(): array
    {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'kompetensi_dasar' => 'required|string',
            'materi_pokok' => 'required|string',
            'tujuan_pembelajaran' => 'required|string',
            'metode_pembelajaran' => 'required|string',
            'sumber_belajar' => 'required|string',
            'penilaian' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }
}

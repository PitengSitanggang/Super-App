<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Otentikasi
            'email' => 'required|email|unique:users,email', // Ngecek langsung ke tabel users standar
            'password' => 'required|min:8',

            // Data Dasar Pegawai
            'nip' => 'required|numeric|unique:teachers,nip', // Ngecek ke tabel teachers
            'nama' => 'required|string|max:255',
            'kelamin' => 'required|in:L,P',
            'no_telepon' => 'nullable|numeric',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ];
    }
}

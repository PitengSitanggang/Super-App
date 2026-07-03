<?php

namespace App\Imports;

use App\Services\TeacherService;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TeacherImport implements OnEachRow, WithHeadingRow, WithValidation
{
    protected $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function onRow(Row $row)
    {
        $rowArray = $row->toArray();

        // Menggunakan TeacherService agar logika pembuatan User dan Teacher konsisten
        $this->teacherService->createTeacher([
            'name' => $rowArray['nama'],
            'email' => $rowArray['email'],
            'password' => 'password123', // Default password sesuai instruksi
            'employee_number' => $rowArray['nip'],
            'gender' => $rowArray['gender'] ?? 'male', // Default jika kolom gender tidak ada
            'status' => $rowArray['status'] ?? 'active',
            'phone_number' => $rowArray['no_hp'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip'   => 'required|unique:teachers,employee_number',
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            'email.unique' => 'Email :input sudah terdaftar di sistem.',
            'nip.unique' => 'NIP :input sudah terdaftar di sistem.',
        ];
    }
}

<?php

namespace App\Imports;

use App\Services\StudentService;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements OnEachRow, WithHeadingRow, WithValidation
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function onRow(Row $row)
    {
        $rowArray = $row->toArray();

        // Ensure we provide required fields for createStudent
        $this->studentService->createStudent([
            'name' => $rowArray['nama'],
            'email' => $rowArray['email'],
            'password' => 'password123', // Default password
            'student_number' => $rowArray['nis'],
            'gender' => $rowArray['gender'] ?? 'male', // Default if missing
            'grade' => $rowArray['grade'] ?? '10', // Default if missing
            'major' => $rowArray['major'] ?? 'General', // Default if missing
        ]);
    }

    public function rules(): array
    {
        return [
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nis'   => 'required|unique:students,student_number',
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            'email.unique' => 'Email :input sudah terdaftar di sistem.',
            'nis.unique' => 'NIS :input sudah terdaftar di sistem.',
        ];
    }
}

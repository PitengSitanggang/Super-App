<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Student::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NIS',
            'Grade',
            'Major',
            'Gender'
        ];
    }

    public function map($student): array
    {
        return [
            $student->user ? $student->user->name : '-',
            $student->user ? $student->user->email : '-',
            $student->student_number,
            $student->grade,
            $student->major,
            $student->gender,
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Teacher::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'NIP',
            'Status'
        ];
    }

    public function map($teacher): array
    {
        return [
            $teacher->name,
            $teacher->user ? $teacher->user->email : '-',
            $teacher->employee_number,
            $teacher->status,
        ];
    }
}

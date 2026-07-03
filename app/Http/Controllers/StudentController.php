<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\StudentService;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->paginate(10);
        return view('student.index', compact('students'));
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'data_siswa.xlsx');
    }

    public function import(Request $request, StudentService $studentService)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new StudentImport($studentService), $request->file('file'));
            return redirect()->route('students.index')->with('success', 'Data Siswa berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->route('students.index')->with('error', 'Validasi gagal: ' . implode(' | ', $errorMessages));
        } catch (Exception $e) {
            return redirect()->route('students.index')->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(StoreStudentRequest $request, StudentService $studentService)
    {
        try {
            $studentService->createStudent($request->validated());
            return redirect()->route('students.index')->with('success', 'Student added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error occurred. Please try again.');
        }
    }

    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student, StudentService $studentService)
    {
        try {
            $studentService->updateStudent($student, $request->validated());
            return redirect()->route('students.index')->with('success', 'Student updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error occurred. Please try again.');
        }
    }

    public function destroy(Student $student)
    {
        if ($student->user) {
            $student->user->delete();
        } else {
            $student->delete();
        }
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TeacherExport;
use App\Imports\TeacherImport;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(10);
        return view('teacher.index', compact('teachers'));
    }

    public function export()
    {
        return Excel::download(new TeacherExport, 'data_guru.xlsx');
    }

    public function import(Request $request, TeacherService $teacherService)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new TeacherImport($teacherService), $request->file('file'));
            return redirect()->route('teachers.index')->with('success', 'Data Guru berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->route('teachers.index')->with('error', 'Validasi gagal: ' . implode(' | ', $errorMessages));
        } catch (Exception $e) {
            return redirect()->route('teachers.index')->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('teacher.create', compact('subjects'));
    }
    public function store(Request $request, TeacherService $teacherService)
    {
        try {
            $teacherService->createTeacher($request->all());
            return redirect()->route('teachers.index')->with('success', 'Data Guru berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }
    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('teacher.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher, TeacherService $teacherService)
    {
        try {
            $teacherService->updateTeacher($teacher, $request->all());
            return redirect()->route('teachers.index')->with('success', 'Data Guru berhasil diupdate!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function destroy(Teacher $teacher)
    {
        // Delete the user account, which will cascade and delete the teacher profile too
        if ($teacher->user) {
            $teacher->user->delete();
        } else {
            $teacher->delete();
        }
        return redirect()->route('teachers.index')->with('success', 'Data Guru berhasil dihapus!');
    }
}

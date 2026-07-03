<?php

namespace App\Http\Controllers;

use App\Models\LessonPlan;
use App\Services\LessonPlanService;
use App\Http\Requests\StoreLessonPlanRequest;
use Exception;
use Illuminate\Http\Request;

class LessonPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Cek langsung ke kolom role/tipe di tabel users
        // Asumsi nama kolomnya adalah 'role'. Sesuaikan jika namamu berbeda.
        $isSuperAdmin = $user->role === 'superadmin';
        $isTeacher = $user->role === 'teacher' || $user->teacher !== null;
        
        if (!$isTeacher && !$isSuperAdmin) {
            return redirect()->route('dashboard')->with('error', 'Fitur ini khusus untuk akun berstatus Guru atau Superadmin.');
        }

        $query = LessonPlan::with('subject');

        if ($isSuperAdmin) {
            $lessonPlans = $query->paginate(10);
        } else {
            // Jika dia teacher, kita ambil relasi teacher-nya untuk mendapatkan ID
            $teacher = $user->teacher;
            $lessonPlans = $query->where('teacher_id', $teacher->id)->paginate(10);
        }

        return view('lesson_plans.index', compact('lessonPlans'));
    }
    
    public function create()
    {
        $teacher = auth()->user()->teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Fitur ini khusus untuk akun berstatus Guru.');
        }

        // Smart Dropdown: Ambil daftar mata pelajaran yang HANYA diampu oleh guru ini
        $subjects = $teacher->subjects;

        return view('lesson_plans.create', compact('subjects'));
    }

    public function store(StoreLessonPlanRequest $request, LessonPlanService $lessonPlanService)
    {
        $teacher = auth()->user()->teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Fitur ini khusus untuk akun berstatus Guru.');
        }

        try {
            // Otomatis menempelkan ID guru ke service
            $lessonPlanService->createLessonPlan($teacher->id, $request->validated());
            return redirect()->route('lesson-plans.index')->with('success', 'Rencana Pembelajaran berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan RPP.')->withInput();
        }
    }

    public function show(LessonPlan $lessonPlan)
    {
        $teacher = auth()->user()->teacher;
        if (!$teacher || $lessonPlan->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke RPP ini.');
        }
        
        return view('lesson_plans.show', compact('lessonPlan'));
    }

    public function edit(LessonPlan $lessonPlan)
    {
        $teacher = auth()->user()->teacher;
        if (!$teacher || $lessonPlan->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke RPP ini.');
        }

        $subjects = $teacher->subjects;
        return view('lesson_plans.edit', compact('lessonPlan', 'subjects'));
    }

    public function update(StoreLessonPlanRequest $request, LessonPlan $lessonPlan, LessonPlanService $lessonPlanService)
    {
        $teacher = auth()->user()->teacher;
        if (!$teacher || $lessonPlan->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke RPP ini.');
        }

        try {
            $lessonPlanService->updateLessonPlan($lessonPlan, $request->validated());
            return redirect()->route('lesson-plans.index')->with('success', 'RPP berhasil diperbarui!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui RPP.')->withInput();
        }
    }

    public function destroy(LessonPlan $lessonPlan)
    {
        $teacher = auth()->user()->teacher;
        if (!$teacher || $lessonPlan->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke RPP ini.');
        }

        $lessonPlan->delete();
        return redirect()->route('lesson-plans.index')->with('success', 'RPP berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Services\SubjectService;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\Request;
use Exception;

class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function index()
    {
        $subjects = Subject::withCount('teachers')->paginate(10);
        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        try {
            $this->subjectService->createSubject($request->validated());
            return redirect()->route('subjects.index')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        try {
            $this->subjectService->updateSubject($subject, $request->validated());
            return redirect()->route('subjects.index')->with('success', 'Mata Pelajaran berhasil diupdate!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function destroy(Subject $subject)
    {
        try {
            $this->subjectService->deleteSubject($subject);
            return redirect()->route('subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat menghapus data.');
        }
    }
}

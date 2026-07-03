<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Teacher;
use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Exception;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('teacher')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('projects.create', compact('teachers'));
    }

    public function store(StoreProjectRequest $request, ProjectService $projectService)
    {
        try {
            $projectService->createProject($request->validated());
            return redirect()->route('projects.index')->with('success', 'Project created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error occurred. Please try again.');
        }
    }

    public function show(Project $project)
    {
        $project->load('tasks', 'teacher');
        // Group tasks by status for the Kanban board
        $tasks = [
            'pending' => $project->tasks->where('status', 'pending'),
            'in_progress' => $project->tasks->where('status', 'in_progress'),
            'completed' => $project->tasks->where('status', 'completed'),
        ];

        return view('projects.show', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        $teachers = Teacher::all();
        return view('projects.edit', compact('project', 'teachers'));
    }

    public function update(UpdateProjectRequest $request, Project $project, ProjectService $projectService)
    {
        try {
            $projectService->updateProject($project, $request->validated());
            return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error occurred. Please try again.');
        }
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}

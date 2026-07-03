<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use Exception;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request, Project $project, TaskService $taskService)
    {
        try {
            $taskService->createTask($project, $request->validated());
            return redirect()->route('projects.show', $project->id)->with('success', 'Task added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to add task.');
        }
    }

    public function updateStatus(UpdateTaskStatusRequest $request, Task $task, TaskService $taskService)
    {
        try {
            $taskService->updateTaskStatus($task, $request->status);
            return redirect()->route('projects.show', $task->project_id)->with('success', 'Task status updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update task status.');
        }
    }
    
    public function destroy(Task $task)
    {
        $projectId = $task->project_id;
        $task->delete();
        return redirect()->route('projects.show', $projectId)->with('success', 'Task deleted successfully!');
    }
}

<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Log;

class TaskService
{
    public function createTask(Project $project, array $data)
    {
        try {
            // Force the project_id to ensure tasks are correctly nested
            $data['project_id'] = $project->id;
            return Task::create($data);
        } catch (Exception $e) {
            Log::error('Failed to create task: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateTaskStatus(Task $task, string $status)
    {
        try {
            $task->update(['status' => $status]);
            return $task;
        } catch (Exception $e) {
            Log::error('Failed to update task status: ' . $e->getMessage());
            throw $e;
        }
    }
}

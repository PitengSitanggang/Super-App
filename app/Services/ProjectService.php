<?php

namespace App\Services;

use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    public function createProject(array $data)
    {
        try {
            return Project::create($data);
        } catch (Exception $e) {
            Log::error('Failed to create project: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateProject(Project $project, array $data)
    {
        try {
            $project->update($data);
            return $project;
        } catch (Exception $e) {
            Log::error('Failed to update project: ' . $e->getMessage());
            throw $e;
        }
    }
}

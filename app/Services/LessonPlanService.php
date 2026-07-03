<?php

namespace App\Services;

use App\Models\LessonPlan;
use Exception;
use Illuminate\Support\Facades\Log;

class LessonPlanService
{
    public function createLessonPlan(int $teacherId, array $data)
    {
        try {
            // Otomatisasi teacher_id untuk keamanan
            $data['teacher_id'] = $teacherId;
            return LessonPlan::create($data);
        } catch (Exception $e) {
            Log::error('Failed to create lesson plan: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateLessonPlan(LessonPlan $lessonPlan, array $data)
    {
        try {
            $lessonPlan->update($data);
            return $lessonPlan;
        } catch (Exception $e) { 
            Log::error('Failed to update lesson plan: ' . $e->getMessage());
            throw $e;
        }
    }
}

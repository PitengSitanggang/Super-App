<?php

namespace App\Services;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class SubjectService
{
    public function createSubject(array $data)
    {
        DB::beginTransaction();
        try {
            $subject = Subject::create([
                'code' => $data['code'],
                'group' => $data['group'] ?? null,
                'name' => $data['name'],
            ]);

            DB::commit();
            return $subject;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create subject: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateSubject(Subject $subject, array $data)
    {
        DB::beginTransaction();
        try {
            $subject->update([
                'code' => $data['code'],
                'group' => $data['group'] ?? null,
                'name' => $data['name'],
            ]);

            DB::commit();
            return $subject;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update subject: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteSubject(Subject $subject)
    {
        try {
            return $subject->delete();
        } catch (Exception $e) {
            Log::error('Failed to delete subject: ' . $e->getMessage());
            throw $e;
        }
    }
}

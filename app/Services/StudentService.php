<?php

namespace App\Services;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentService
{
    public function createStudent(array $data)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'student',
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'student_number' => $data['student_number'],
                'gender' => $data['gender'],
                'place_of_birth' => $data['place_of_birth'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'address' => $data['address'] ?? null,
                'parent_name' => $data['parent_name'] ?? null,
                'parent_phone_number' => $data['parent_phone_number'] ?? null,
                'grade' => $data['grade'],
                'major' => $data['major'],
            ]);

            DB::commit();
            return $student;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create student: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateStudent(Student $student, array $data)
    {
        DB::beginTransaction();
        try {
            $userData = ['email' => $data['email'], 'name' => $data['name']];
            if (!empty($data['password'])) {
                $userData['password'] = bcrypt($data['password']);
            }
            $student->user->update($userData);

            $student->update([
                'student_number' => $data['student_number'],
                'gender' => $data['gender'],
                'place_of_birth' => $data['place_of_birth'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'address' => $data['address'] ?? null,
                'parent_name' => $data['parent_name'] ?? null,
                'parent_phone_number' => $data['parent_phone_number'] ?? null,
                'grade' => $data['grade'],
                'major' => $data['major'],
            ]);

            DB::commit();
            return $student;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update student: ' . $e->getMessage());
            throw $e;
        }
    }
}

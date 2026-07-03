<?php

namespace App\Services;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class TeacherService
{
    public function createTeacher(array $data)
    {
        DB::beginTransaction();
        try {
            // 2. Insert ke tabel Users dulu (buat otentikasi login)
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']), // Jangan lupa di-hash!
                'role' => 'teacher',
            ]);

            // 3. Insert ke tabel Teachers (Biodata dasar guru)
            $teacher = Teacher::create([
                'user_id' => $user->id, // Ambil ID dari user yang baru aja dibuat
                'employee_number' => $data['employee_number'],
                'name' => $data['name'],
                'gender' => $data['gender'],
                'phone_number' => $data['phone_number'] ?? null,
                'status' => 'active',
            ]);

            // 4. Sync Mata Pelajaran (Buat relasi many-to-many)
            if (!empty($data['subject_ids'])) {
                $teacher->subjects()->sync($data['subject_ids']);
            }

            // 5. Kalau semua sukses, simpan permanen ke database
            DB::commit();

            return $teacher;

        } catch (Exception $e) {
            // 5. Kalau ada yang gagal (misal server down), BATALKAN SEMUA
            DB::rollBack();

            // 6. Catat error-nya ke file log (Biar gampang nyari bug)
            Log::error('Gagal membuat data guru: ' . $e->getMessage());

            // 7. Lempar error-nya biar ditangkap sama Controller
            throw $e;
        }

    }

    public function updateTeacher(Teacher $teacher, array $data)
    {
        DB::beginTransaction();
        try {
            // Update User data
            $userData = ['email' => $data['email']];
            if (!empty($data['password'])) {
                $userData['password'] = bcrypt($data['password']);
            }
            $teacher->user->update($userData);

            // Update Teacher profile data
            $teacher->update([
                'employee_number' => $data['employee_number'],
                'name' => $data['name'],
                'gender' => $data['gender'],
                'phone_number' => $data['phone_number'] ?? null,
                'status' => $data['status'] ?? 'active',
            ]);

            // Sync Mata Pelajaran
            $teacher->subjects()->sync($data['subject_ids'] ?? []);

            DB::commit();
            return $teacher;
        } catch (Exception $e) {
            // 5. Kalau ada yang gagal (misal server down), BATALKAN SEMUA
            DB::rollBack();

            // 6. Catat error-nya ke file log (Biar gampang nyari bug)
            Log::error('Gagal mengupdate data guru: ' . $e->getMessage());

            // 7. Lempar error-nya biar ditangkap sama Controller
            throw $e;
        }
    }
}
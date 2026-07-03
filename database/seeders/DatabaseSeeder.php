<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // 1. Create Superadmin User
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@superapp.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        // 2. Create 12 Subjects
        $subjects = [];
        $subjectNames = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Biologi',
            'Fisika',
            'Kimia',
            'Sejarah',
            'Geografi',
            'Ekonomi',
            'Sosiologi',
            'Pendidikan Agama',
            'Pendidikan Jasmani'
        ];

        foreach ($subjectNames as $index => $name) {
            $subjects[] = \App\Models\Subject::create([
                'code' => 'SUBJ-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'group' => $faker->randomElement(['A', 'B', 'C']),
                'name' => $name,
            ]);
        }

        // 3. Create 20 Teachers
        for ($i = 1; $i <= 20; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            $name = $faker->name($gender);

            $user = User::create([
                'name' => $name,
                'email' => "guru{$i}@superapp.com",
                'password' => bcrypt('password'),
                'role' => 'teacher',
            ]);

            $teacher = \App\Models\Teacher::create([
                'user_id' => $user->id,
                'employee_number' => 'NIP' . $faker->unique()->numerify('##########'),
                'name' => $name,
                'gender' => $gender,
                'phone_number' => $faker->phoneNumber,
                'status' => 'active',
            ]);

            // Assign 1-3 random subjects to each teacher
            $randomSubjects = collect($subjects)->random(rand(1, 3))->pluck('id');
            $teacher->subjects()->attach($randomSubjects);
        }

        // 4. Create 20 Students
        for ($i = 1; $i <= 20; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            $name = $faker->name($gender);

            $user = User::create([
                'name' => $name,
                'email' => "siswa{$i}@superapp.com",
                'password' => bcrypt('password'),
                'role' => 'student',
            ]);

            \App\Models\Student::create([
                'user_id' => $user->id,
                'student_number' => 'NIS' . $faker->unique()->numerify('######'),
                'gender' => $gender,
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->date(),
                'address' => $faker->address,
                'parent_name' => $faker->name,
                'parent_phone_number' => $faker->phoneNumber,
                'grade' => $faker->randomElement(['10', '11', '12']),
                'major' => $faker->randomElement(['TIK', 'RPL', 'ANIMASI', 'BROADCAST']),
            ]);
        }
    }
}

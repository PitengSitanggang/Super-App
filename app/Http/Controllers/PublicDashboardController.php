<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Project;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Task;
use Carbon\Carbon;

class PublicDashboardController extends Controller
{
    public function index()
    {
        // Metric Cards Data
        $totalTeachers = Teacher::count();
        $totalStudents = User::whereIn('role', ['student', 'siswa'])->count();
        $totalSubjects = Subject::count();

        // Data Chart 1: Teachers vs Students (Pie Chart)
        $chart1Labels = json_encode(['Teachers', 'Students']);
        $chart1Data = json_encode([$totalTeachers, $totalStudents]);

        // Data Chart 2: Schedules per Day (Bar Chart)
        $scheduleStats = Schedule::groupBy('day')
            ->selectRaw('day, count(*) as total')
            ->pluck('total', 'day');
            
        $daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $sortedSchedules = collect();
        foreach ($daysOrder as $day) {
            $sortedSchedules[$day] = $scheduleStats->get($day, 0);
        }

        $chart2Labels = $sortedSchedules->keys()->toJson();
        $chart2Data = $sortedSchedules->values()->toJson();

        // Data Chart 3: Projects Berjalan vs Selesai (Doughnut Chart)
        $projectsCompleted = Project::where('end_date', '<', Carbon::today())->count();
        $projectsRunning = Project::count() - $projectsCompleted;

        $chart3Labels = json_encode(['Running (Berjalan)', 'Completed (Selesai)']);
        $chart3Data = json_encode([$projectsRunning, $projectsCompleted]);

        // Data Chart 4: Users by Role (Polar Area Chart)
        $userStats = User::groupBy('role')
            ->selectRaw('role, count(*) as total')
            ->pluck('total', 'role');
        $chart4Labels = $userStats->keys()->toJson();
        $chart4Data = $userStats->values()->toJson();

        // Data Chart 5: Tasks by Status (Horizontal Bar)
        $taskStats = Task::groupBy('status')
            ->selectRaw('status, count(*) as total')
            ->pluck('total', 'status');
        $chart5Labels = $taskStats->keys()->toJson();
        $chart5Data = $taskStats->values()->toJson();

        return view('public-dashboard', compact(
            'totalTeachers', 'totalStudents', 'totalSubjects',
            'chart1Labels', 'chart1Data',
            'chart2Labels', 'chart2Data',
            'chart3Labels', 'chart3Data',
            'chart4Labels', 'chart4Data',
            'chart5Labels', 'chart5Data'
        ));
    }
}

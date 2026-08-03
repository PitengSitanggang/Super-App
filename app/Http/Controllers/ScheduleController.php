<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Subject;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        $schedules = $this->scheduleService->getAllSchedules();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return view('schedules.create', compact('teachers', 'subjects', 'days'));
    }

    public function store(StoreScheduleRequest $request)
    {
        $this->scheduleService->createSchedule($request->validated());
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return view('schedules.edit', compact('schedule', 'teachers', 'subjects', 'days'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $this->scheduleService->updateSchedule($schedule, $request->validated());
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $this->scheduleService->deleteSchedule($schedule);
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }

    public function timetable()
    {
        $allSchedules = Schedule::with(['teacher', 'subject'])->get();
        
        $groupedSchedules = [];
        foreach ($allSchedules as $schedule) {
            $groupedSchedules[$schedule->class_name][$schedule->day][$schedule->period] = $schedule;
        }

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $periods = [1, 2, 3, 4, 5, 6, 7];
        
        return view('schedules.timetable', compact('groupedSchedules', 'days', 'periods'));
    }
}

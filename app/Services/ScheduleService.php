<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;

class ScheduleService
{
    public function getAllSchedules(): Collection
    {
        return Schedule::with(['teacher', 'subject'])->orderBy('day')->orderBy('period')->get();
    }

    public function createSchedule(array $data): void
    {
        $periods = $data['period'];
        foreach ($periods as $period) {
            $scheduleData = $data;
            $scheduleData['period'] = $period;
            Schedule::create($scheduleData);
        }
    }

    public function getScheduleById(int $id): Schedule
    {
        return Schedule::findOrFail($id);
    }

    public function updateSchedule(Schedule $schedule, array $data): bool
    {
        $periods = $data['period'];
        $firstPeriod = array_shift($periods);
        
        $updateData = $data;
        $updateData['period'] = $firstPeriod;
        $result = $schedule->update($updateData);

        foreach ($periods as $period) {
            $newData = $data;
            $newData['period'] = $period;
            Schedule::create($newData);
        }

        return $result;
    }

    public function deleteSchedule(Schedule $schedule): bool
    {
        return $schedule->delete();
    }
}

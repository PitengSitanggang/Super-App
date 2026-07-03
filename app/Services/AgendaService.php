<?php

namespace App\Services;

use App\Models\Agenda;
use Illuminate\Support\Facades\Log;
use Exception;

class AgendaService
{
    public function getAllAgendasForCalendar()
    {
        $agendas = Agenda::all();
        $formatted = [];

        foreach ($agendas as $agenda) {
            $formatted[] = [
                'id' => $agenda->id,
                'title' => $agenda->title,
                'start' => $agenda->start_date,
                'end' => $agenda->end_date,
                'color' => $agenda->color ?? '#4f46e5', // Default color if null
            ];
        }

        return $formatted;
    }

    public function createAgenda(array $data)
    {
        try {
            return Agenda::create([
                'title' => $data['title'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'color' => $data['color'] ?? '#4f46e5',
            ]);
        } catch (Exception $e) {
            Log::error('Failed to create agenda: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateAgenda(Agenda $agenda, array $data)
    {
        try {
            $agenda->update([
                'title' => $data['title'] ?? $agenda->title,
                'start_date' => $data['start_date'] ?? $agenda->start_date,
                'end_date' => array_key_exists('end_date', $data) ? $data['end_date'] : $agenda->end_date,
                'color' => $data['color'] ?? $agenda->color,
            ]);
            return $agenda;
        } catch (Exception $e) {
            Log::error('Failed to update agenda: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteAgenda(Agenda $agenda)
    {
        try {
            $agenda->delete();
            return true;
        } catch (Exception $e) {
            Log::error('Failed to delete agenda: ' . $e->getMessage());
            throw $e;
        }
    }
}

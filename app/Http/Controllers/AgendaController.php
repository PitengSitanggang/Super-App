<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Services\AgendaService;
use Illuminate\Http\Request;
use Exception;

class AgendaController extends Controller
{
    public function index(Request $request, AgendaService $agendaService)
    {
        if ($request->ajax() || $request->wantsJson() || $request->has('start')) {
            return response()->json($agendaService->getAllAgendasForCalendar());
        }
        return view('agendas.index');
    }

    public function store(Request $request, AgendaService $agendaService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'color' => 'nullable|string|max:50',
        ]);

        try {
            $agenda = $agendaService->createAgenda($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Agenda created successfully',
                'data' => $agenda
            ], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Agenda $agenda, AgendaService $agendaService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'color' => 'nullable|string|max:50',
        ]);

        try {
            $updated = $agendaService->updateAgenda($agenda, $request->all());
            return response()->json([
                'success' => true,
                'message' => 'Agenda updated successfully',
                'data' => $updated
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Agenda $agenda, AgendaService $agendaService)
    {
        try {
            $agendaService->deleteAgenda($agenda);
            return response()->json([
                'success' => true,
                'message' => 'Agenda deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

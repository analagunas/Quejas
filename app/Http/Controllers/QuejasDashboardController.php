<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class QuejasDashboardController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->get();

        $total = $complaints->count();

        /* ==========================
           Quejas por TEMA
        ========================== */
        $byTheme = [];

        foreach ($complaints as $complaint) {
            $themes = json_decode($complaint->temas, true);

            if (!is_array($themes)) {
                continue;
            }

            foreach ($themes as $theme) {
                $byTheme[$theme] = ($byTheme[$theme] ?? 0) + 1;
            }
        }

        /* ==========================
           Quejas por STATUS
        ========================== */
        $byStatus = $complaints
            ->groupBy('status')
            ->map(fn($group) => $group->count());

        /* ==========================
           Quejas por UNIDAD
        ========================== */
        $byUnit = $complaints
            ->groupBy('unidad')
            ->map(fn($group) => $group->count());

        return view('quejas.dashboard', compact(
            'total',
            'byTheme',
            'byStatus',
            'byUnit',
            'complaints'
        ));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        // ✅ AQUÍ ESTABA EL ERROR
        $complaint->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Estatus actualizado correctamente');
    }
}

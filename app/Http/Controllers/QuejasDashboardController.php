<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintStatusHistory;
use Illuminate\Support\Facades\Auth;

class QuejasDashboardController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('topic')->latest()->get();

        $total = $complaints->count();

        /* ==========================
       Quejas por TEMA (usando relación)
    ========================== */
        $byTheme = $complaints
            ->groupBy(fn($c) => $c->topic?->name ?? 'Sin tema')
            ->map(fn($group) => $group->count());

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
        // Si ya está resuelta, no permitir cambios
        if ($complaint->status === 'Resuelta') {
            return back()->withErrors('Esta queja ya fue marcada como resuelta y no puede modificarse.');
        }

        $request->validate([
            'status' => 'required|string',
            'comment' => 'required|string|min:5',
        ]);

        $oldStatus = $complaint->status;

        $complaint->update([
            'status' => $request->status,
        ]);

        ComplaintStatusHistory::create([
            'complaint_id' => $complaint->id,
            'user_id' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Estatus actualizado correctamente');
    }
}

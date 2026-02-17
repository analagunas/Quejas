<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class PublicTrackingController extends Controller
{
    public function form()
    {
        return view('quejas.tracking.form');
    }

    public function search(Request $request)
    {
        $request->validate([
            'folio' => 'required|string'
        ]);

        $complaint = Complaint::with('statusHistory.user')
            ->where('folio', $request->folio)
            ->first();

        return view('quejas.tracking.form', compact('complaint'));
    }

    public function reply(Request $request, Complaint $complaint)
    {
        $request->validate([
            'reply' => 'required|string|max:1000'
        ]);

        $complaint->statusHistory()->create([
            'user_id' => 1, // usuario externo
            'old_status' => $complaint->status,
            'new_status' => $complaint->status,
            'comment' => $request->reply
        ]);

        return back()->with('success', 'Tu respuesta fue enviada');
    }
}

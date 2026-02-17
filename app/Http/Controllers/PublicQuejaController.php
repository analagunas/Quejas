<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\ComplaintTopic;
use App\Models\Position;

use Illuminate\Support\Str;

class PublicQuejaController extends Controller
{
    public function create()
    {
        $positions = Position::orderBy('name')->get();
        $topics = ComplaintTopic::orderBy('name')->get();

        return view('quejas.public.create', compact('positions', 'topics'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'es_anonima' => 'required|boolean',

            'nombre' => 'nullable|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email',
            'puesto' => 'required|string|max:255',

            'complaint_topic_id' => 'required|exists:complaint_topics,id',
            'situacion' => 'required|string',
            'impacto' => 'required|string',
            'mejora' => 'required|string',
            'comentarios' => 'nullable|string',
            'unidad' => 'required|string',
        ]);

        if ($data['es_anonima']) {
            $data['nombre'] = null;
            $data['apellido_paterno'] = null;
            $data['apellido_materno'] = null;
            $data['telefono'] = null;
            $data['correo'] = null;
        }

        $data['folio'] = 'QJ-' . strtoupper(Str::random(6));

        Complaint::create($data);

        return redirect()->route('quejas.gracias')
            ->with('folio', $data['folio']);
    }

    public function show(Complaint $complaint)
    {
        $complaint->load('statusHistory.user');
        return view('quejas.show', compact('complaint'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        // 🚨 BLOQUEO BACKEND
        if ($complaint->status === 'Resuelta') {
            return back()->with('error', 'La queja ya está resuelta y no permite cambios.');
        }

        // VALIDAR
        $request->validate([
            'status' => 'required|string',
            'comment' => 'required|string|max:1000'
        ]);

        // GUARDAR STATUS ANTERIOR
        $oldStatus = $complaint->status;

        // ACTUALIZAR STATUS ACTUAL
        $complaint->update([
            'status' => $request->status
        ]);

        // GUARDAR HISTORIAL
        $complaint->statusHistory()->create([
            'user_id' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $request->status,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Estatus actualizado correctamente.');
    }
}

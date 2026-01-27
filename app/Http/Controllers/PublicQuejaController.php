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
}

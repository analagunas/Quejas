<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class PublicQuejaController extends Controller
{
    public function create()
    {
        return view('quejas.public.create');
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
            'puesto' => 'nullable|string|max:255',

            'temas' => 'required|array',
            'otro_tema' => 'nullable|string|max:255',
            'situacion' => 'required|string',
            'impacto' => 'required|string',
            'mejora' => 'required|string',
            'comentarios' => 'nullable|string',
            'unidad' => 'required|string',
        ]);

        // Guardar JSON
        $data['temas'] = json_encode($data['temas']);

        // Si es anónima, limpiar datos personales
        if ($data['es_anonima']) {
            $data['nombre'] = null;
            $data['apellido_paterno'] = null;
            $data['apellido_materno'] = null;
            $data['telefono'] = null;
            $data['correo'] = null;
            $data['puesto'] = null;
        }

        Complaint::create($data);

        return redirect()->route('quejas.gracias');
    }
}

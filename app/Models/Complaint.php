<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'es_anonima',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'correo',
        'puesto',
        'temas',
        'otro_tema',
        'situacion',
        'impacto',
        'mejora',
        'comentarios',
        'unidad',
        'otro_tema',
        'status',
    ];

    protected $casts = [
        'temas' => 'array',
        'es_anonima' => 'boolean',
    ];

    public function topics()
    {
        return $this->belongsToMany(ComplaintTopic::class);
    }
}

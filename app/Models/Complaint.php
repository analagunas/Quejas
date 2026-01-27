<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'folio',
        'es_anonima',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'correo',
        'puesto',
        'complaint_topic_id',
        'situacion',
        'impacto',
        'mejora',
        'comentarios',
        'unidad',
        'status',
    ];

    protected $casts = [
        'es_anonima' => 'boolean',
    ];

    public function topic()
    {
        return $this->belongsTo(ComplaintTopic::class, 'complaint_topic_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(ComplaintStatusHistory::class);
    }
}

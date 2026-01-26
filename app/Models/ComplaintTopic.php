<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintTopic extends Model
{
    protected $fillable = ['name'];

    public function complaints()
    {
        return $this->belongsToMany(Complaint::class);
    }
}

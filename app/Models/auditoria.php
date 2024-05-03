<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auditoria extends Model
{
    protected $fillable = [
        'reporte_id',
        'revisado',
        'observaciones'
    ];

    public function reporte()
    {
        return $this->belongsTo(reportes::class);
    }
}

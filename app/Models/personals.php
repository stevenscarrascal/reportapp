<?php

namespace App\Models;

use App\Models\vs_cargo;
use App\Models\vs_tipo_documento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personals extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'correo',
        'cargo',
        'estado',
    ];

    public function tipodocumento(){

        return $this->hasOne(vs_tipo_documento::class, 'id', 'tipo_documento');
    }

    public function cargos()
    {
        return $this->hasOne(vs_cargo::class, 'id', 'cargo');
    }

    public function estado()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }
}

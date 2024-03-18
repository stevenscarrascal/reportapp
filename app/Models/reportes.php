<?php

namespace App\Models;

use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    static $rules = [
        'contrato' => 'required',
        'lectura' => 'required',
        'anomalia' => 'required',
        'foto1' => 'required|image|max:5120',
        'foto2' => 'image|max:5120',
        'foto3' => 'image|max:5120',
        'foto4' => 'image|max:5120',
        'foto5' => 'image|max:5120',
        'foto6' => 'image|max:5120'
    ];
    static $rulesupdate = [
        'contrato' => 'required',
        'lectura' => 'required',
        'anomalia' => 'required',
        'imposibilidad' => 'nullable',
        'observacion' => 'nullable',
        'motivo' => 'nullable',
        'foto1' => 'image|max:5120',
        'foto2' => 'image|max:5120',
        'foto3' => 'image|max:5120',
        'foto4' => 'image|max:5120',
        'foto5' => 'image|max:5120',
        'foto6' => 'image|max:5120',
    ];

    protected $fillable = [
        'personal_id',
        'contrato',
        'lectura',
        'anomalia',
        'imposibilidad',
        'direccion',
        'observaciones',
        'latitud',
        'longitud',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        'estado'
    ];

    public function personal()
    {
        return $this->belongsTo(personals::class);
    }


    public function EstadoReporte()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'longitud',
        'latitud',
    ];

    public function reportes(){
        
        return $this->hasOne(reportes::class);
    }

}

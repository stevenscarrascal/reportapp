<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\personals;

class vs_cargo extends Model
{
    use HasFactory;
    protected $table = 'vs_cargo';
    public function personal()
      {
          return $this->belongsTo(personals::class);
      }
}

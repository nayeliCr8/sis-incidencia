<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function perfils()
    {
        return $this->hasMany(Perfil::class);
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
}

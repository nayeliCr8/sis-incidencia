<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }

    public static $estados = ['Pesimo','Regular', 'Bueno','Excelente'];
}

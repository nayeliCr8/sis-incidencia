<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function oficina()
    {
        return $this->belongsTo(Oficina::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

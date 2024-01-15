<?php

namespace App\Models\Suscripcion;

use App\Models\Perfil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function suscripcion(){
        return $this->hasMany(Suscripcion::class,'tipo_id','id');
    }
    public function perfil(){
        return $this->hasMany(Perfil::class,'tipo_id','id');
    }
}

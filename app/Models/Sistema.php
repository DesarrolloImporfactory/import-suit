<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Sistema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tipo',
        'ruta',
    ];

    public function permisos()
    {
        return $this->hasMany(Permission::class, 'sistema_id', 'id');
    }

    public function suscripcion(){
        return $this->hasMany(Suscripcion::class,'sistema_id','id');
    }

    public function perfil(){
        return $this->hasMany(Perfil::class,'sistema_id','id');
    }
}

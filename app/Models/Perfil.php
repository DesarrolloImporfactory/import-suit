<?php

namespace App\Models;

use App\Models\Suscripcion\Tipo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema;
use App\Models\Name;

class Perfil extends Model
{
    use HasFactory;
    protected $fillable = [
        'sistema_id',
        'name_id',
        'tipo_id',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'dias'
    ];

    public function names(){
        return $this->belongsTo(Name::class,'name_id','id');
    }

    public function tipos(){
        return $this->belongsTo(Tipo::class,'tipo_id','id');
    }
    public function sistemas(){
        return $this->belongsTo(Sistema::class,'sistema_id','id');
    }
}

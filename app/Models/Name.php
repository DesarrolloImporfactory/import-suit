<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','precio'
    ];

    public function perfil(){
        return $this->hasMany(Perfil::class,'name_id','id');
    }
}

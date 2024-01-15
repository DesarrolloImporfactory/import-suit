<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['tipo','archivo','producto_id'];

    public function productos(){
        return $this->belongsTo(Product::class,'producto_id','id');
    }
}

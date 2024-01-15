<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['photo','producto_id'];

    public function productos(){
        return $this->belongsTo(Product::class,'producto_id','id');
    }
}

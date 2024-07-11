<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function productos(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function usuarios(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

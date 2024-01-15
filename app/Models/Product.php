<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['video','proveedor_id', 'categoria_id', 'name','paint', 'enlace', 'description', 'estado','stock', 'price_china', 'price_latam', 'price_mayor', 'price_public', 'photo'];

    public function categorias(){
        return $this->belongsTo(Category::class, 'categoria_id','id');
    }

    public function proveedores(){
        return $this->belongsTo(Provider::class,'proveedor_id','id');
    }

    public function images(){
        return $this->hasMany(Image::class,'producto_id','id');
    }

    public function favoritos(){
        return $this->hasMany(Favorite::class,'product_id','id');
    }
}

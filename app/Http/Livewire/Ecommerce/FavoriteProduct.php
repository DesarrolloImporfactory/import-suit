<?php

namespace App\Http\Livewire\Ecommerce;

use App\Models\Favorite;
use Livewire\Component;

class FavoriteProduct extends Component
{
   
    protected $listeners=['count'=>'render'];

    public function render()
    {
        $favoritos = Favorite::where('user_id', auth()->user()->id)->get();
        return view('livewire.ecommerce.favorite-product',compact('favoritos'));
    }
}

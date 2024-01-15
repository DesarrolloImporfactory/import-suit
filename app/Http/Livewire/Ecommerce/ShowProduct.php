<?php

namespace App\Http\Livewire\Ecommerce;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ShowProduct extends Component
{

    public $producto,$favoritos, $agregado, $firstImage, $contenido;

    public function mount(Product $producto)
    {
        $this->producto = $producto;
        if ($this->producto->paint) {
            $this->contenido = Storage::get($this->producto->paint);
        }
        $this->favoritos = Favorite::where('user_id',auth()->user()->id)->get();
    }
    public function render()
    {
        return view('livewire.ecommerce.show-product');
    }

    public function favorito(Product $producto)
    {
        Favorite::create([
            'product_id' => $producto->id,
            'user_id' => auth()->user()->id
        ]);
        $this->emit('count');
        $this->favoritos = Favorite::where('user_id',auth()->user()->id)->get();
        $this->agregado = 'false';
        $this->emit('alert', 'Producto agregado a mi lista!');
    }
}

<?php

namespace App\Http\Livewire\Ecommerce;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class IndexProduct extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $categoria_id;

    public function render()
    {
        $categorias = Category::all();
        $consulta = Product::where('name', 'like', '%' . $this->search . '%');

        if (strlen($this->categoria_id) > 0) {
            $valor = $this->categoria_id;
            $consulta->where(function ($query) use ($valor) {
                $query->where('categoria_id', $valor);
            });
        }
        $productos = $consulta->paginate(8);
        return view('livewire.ecommerce.index-product',compact('productos','categorias'));
    }
}

<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Multimedia;
use App\Models\Product;
use App\Models\Provider;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AdminProducts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $archivo;
    protected $paginationTheme = 'bootstrap';
    public $sort = "id", $direction = "asc";
    public $search = '', $paginate = '5', $filterCategory, $filterProvider, $idProducto;
    protected $listeners = ['delete'];
    public $archivos = [], $name, $video, $price_china, $price_latam, $price_mayor, $price_public, $estado, $photo, $proveedor, $categoria, $description, $enlace, $imagen, $identificador, $codigo, $producto;

    public function render()
    {
        $categorias = Category::all();
        $proveedores = Provider::all();
        $consulta = Product::with('categorias', 'proveedores')->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction);
        if (strlen($this->filterCategory) > 0) {
            $valor = $this->filterCategory;
            $consulta->where(function ($query) use ($valor) {
                $query->where('categoria_id', $valor);
            });
        }
        if (strlen($this->filterProvider) > 0) {
            $valor = $this->filterProvider;
            $consulta->where(function ($query) use ($valor) {
                $query->where('proveedor_id', $valor);
            });
        }
        $productos = $consulta->paginate(8);
        return view('livewire.products.admin-products', compact('categorias', 'proveedores', 'productos'))->extends('adminlte::page')
            ->section('content');
    }
   
    public function order($valor)
    {
        if ($this->sort == $valor) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $valor;
            $this->direction = 'asc';
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
   
    public function delete(Int $id): void
    {
        try {
            $producto = Product::findOrFail($id);
            if ($producto->photo) {
                Storage::delete('public/' . $producto->photo);
            }
            $producto->delete();
            $this->emit('alert', 'Registro eliminado exitosamente!');
        } catch (Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function multimedia(Int $id)
    {
        $this->idProducto = $id;
        $this->archivos = Multimedia::where('producto_id', $id)->get();
    }
    public function store()
    {
        $this->validate([
            'archivo' => 'required|mimes:rar|max:100000', // Validación de tipo de archivo requerido
        ]);
        try {
            $path = $this->archivo->store('videos', 'public');
            Multimedia::create([
                'archivo' => $path,
                'producto_id' => $this->idProducto
            ]);
            $this->multimedia($this->idProducto);
            $this->emit('alert', 'Archivo guardado!');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }

    public function destroy(Int $id)
    {
        try {
            Multimedia::destroy($id);
            $this->multimedia($this->idProducto);
            $this->emit('alert', 'Archivo eliminado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
}

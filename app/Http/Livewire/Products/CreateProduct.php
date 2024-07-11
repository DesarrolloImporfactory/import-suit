<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreateProduct extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $archivo, $paint, $stock;
    public $files = [];
    protected $paginationTheme = 'bootstrap';
    public $sort = "id", $direction = "asc";
    public $search = '', $paginate = '5', $filterCategory, $filterProvider, $idProducto;
    protected $listeners = ['delete'];
    public $archivos = [], $name, $video, $price_china, $price_latam, $price_mayor, $price_public, $estado, $photo, $proveedor, $categoria, $description, $enlace, $imagen, $identificador, $codigo, $producto;

    public function render()
    {
        $categorias = Category::all();
        $proveedores = Provider::all();
        return view('livewire.products.create-product', compact('categorias', 'proveedores'))->extends('adminlte::page')
            ->section('content');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $rules = [
        'name' => 'required|min:2|unique:products',
        'price_china' => 'required|numeric',
        'price_latam' => 'required|numeric',
        'price_mayor' => 'required|numeric',
        'price_public' => 'required|numeric',
        'estado' => 'required',
        'video' => 'required',
        'photo' => 'required|image',
        'files.*' => [
            'required',
            'mines:png,jpg,jpeg'
        ],
        'categoria' => 'required',
        'enlace' => 'required',
        'proveedor' => 'required',
        'stock' => 'required',
        'paint' => 'required'
    ];

    public function create()
    {
        $this->validate();
        try {
            $imagen = $this->photo->store('photos', 'public');
            $producto = Product::create([
                'name' => $this->name,
                'price_china' => $this->price_china,
                'price_latam' => $this->price_latam,
                'price_mayor' => $this->price_mayor,
                'price_public' => $this->price_public,
                'estado' => $this->estado,
                'video' => $this->video,
                'enlace' => $this->enlace,
                'photo' => $imagen,
                'stock' => $this->stock,
                'paint' => $this->paint,
                'proveedor_id' => $this->proveedor,
                'categoria_id' => $this->categoria,
                'description' => $this->description
            ]);
            foreach ($this->files as $key => $file) {
                $image = $file->store('imagenes', 'public');
                $producto->images()->create([
                    'photo' => $image
                ]);
            }
            return redirect()->to('/admin/products')->with('message', '¡Formulario de contacto enviado con éxito!');
        } catch (\Exception $e) {
            dd('alert', $e->getMessage());
        }
    }
}

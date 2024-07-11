<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateProduct extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $paint,$idProducto, $ruta,$contenido, $files = [], $stock, $photo, $photos = [];
    public $name, $video, $price_china, $price_latam, $price_mayor, $price_public, $estado, $proveedor, $categoria, $description, $enlace, $imagen, $producto;

    public function mount(Product $producto)
    {
        $this->producto = $producto;
        $this->name = $this->producto->name;
        $this->price_china = $this->producto->price_china;
        $this->price_latam = $this->producto->price_latam;
        $this->price_mayor = $this->producto->price_mayor;
        $this->price_public = $this->producto->price_public;
        $this->imagen = $this->producto->photo;
        $this->enlace = $this->producto->enlace;
        $this->video = $this->producto->video;
        $this->proveedor = $this->producto->proveedor_id;
        $this->categoria = $this->producto->categoria_id;
        $this->estado = $this->producto->estado;
        $this->paint = $this->producto->paint;
        $this->stock = $this->producto->stock;
        $this->description = $this->producto->description;
        $this->files = $this->producto->images;
        $this->ruta = $this->producto->paint;
        $this->idProducto = $this->producto->id;
        $this->contenido = Storage::get($this->producto->paint);
    }

    public function render()
    {
        $categorias = Category::all();
        $proveedores = Provider::all();

        return view('livewire.products.update-product', compact('categorias', 'proveedores'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $rules = [
        'name' => 'required|min:2',
        'price_china' => 'required|numeric',
        'price_latam' => 'required|numeric',
        'price_mayor' => 'required|numeric',
        'price_public' => 'required|numeric',
        'estado' => 'required',
        'categoria' => 'required',
        'video' => 'required',
        'enlace' => 'required',
        'proveedor' => 'required',
        'stock' => 'required',
        'paint' => 'required',
        'photos.*' => 'image',
    ];

    public function update()
    {
        $this->validate();
        try {
            $rutaArchivo = $this->paintTxt($this->paint, $this->ruta,$this->idProducto);
            $imagen = $this->producto->photo;
            if ($this->photo) {
                $imagen = $this->photo->store('photos', 'public');
                if ($this->producto->photo) {
                    Storage::delete('public/' . $this->producto->photo);
                }
            }
            $this->producto->update([
                'name' => $this->name,
                'price_china' => $this->price_china,
                'price_latam' => $this->price_latam,
                'price_mayor' => $this->price_mayor,
                'price_public' => $this->price_public,
                'estado' => $this->estado,
                'stock' => $this->stock,
                'paint' => $rutaArchivo,
                'enlace' => $this->enlace,
                'video' => $this->video,
                'photo' => $imagen,
                'proveedor_id' => $this->proveedor,
                'categoria_id' => $this->categoria,
                'description' => $this->description
            ]);
            if ($this->photos) {
                if ($this->producto->images) {
                    $this->producto->images()->delete();
                    foreach ($this->producto->images as $value) {
                        Storage::delete('public/' . $value->photo);
                    }
                }
                foreach ($this->photos as $key => $file) {
                    $image = $file->store('imagenes', 'public');
                    $this->producto->images()->create([
                        'photo' => $image
                    ]);
                }
            }
            return redirect()->to('/admin/products')->with('message', '¡Formulario de producto actualizado con éxito!');
        } catch (\Exception $e) {
            dd('alert', $e->getMessage());
        }
    }

    public function paintTxt($contenido, $ruta,$idProducto)
    {
        Storage::delete($ruta);
        $content = $contenido;
        $filename = $idProducto . time() . '.txt';
        Storage::put('public/descripcion/' . $filename, $content);
        $rutaArchivo = 'public/descripcion/' . $filename;
        return $rutaArchivo;
    }
}

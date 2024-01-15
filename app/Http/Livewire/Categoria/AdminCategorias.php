<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Category;
use Livewire\Component;

class AdminCategorias extends Component
{
    public $sort = 'id', $direction = 'asc', $search = '';
    public $name, $idCategoria;
    protected $listeners = ['delete'];

    public function render()
    {
        $categorias = Category::where('name', 'like', '%' . $this->search . '%')->orWhere('id', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)->paginate(10);
        return view('livewire.categoria.admin-categorias', compact('categorias'));
    }
    public $rules = [
        'name' => 'required|string|min:2|max:20|unique:categories',
    ];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
    public function create()
    {
        $this->validate();
        try {
            Category::create([
                'name' => $this->name,
            ]);
            $this->reset(['name']);
            $this->emit('alert', 'Registro creado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function show(Int $id)
    {
        try {
            $categoria = Category::findOrFail($id);
            $this->name = $categoria->name;
            $this->idCategoria = $categoria->id;
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:20',
        ]);
        try {
            Category::where('id', $this->idCategoria)->update([
                'name' => $this->name
            ]);
            $this->reset(['name']);
            $this->emit('alert', 'Registro update con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function delete(Int $id)
    {
        try {
            Category::destroy($id);
            $this->emit('alert', 'Registro eliminado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
}

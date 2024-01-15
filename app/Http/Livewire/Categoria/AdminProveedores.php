<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Provider;
use Livewire\Component;

class AdminProveedores extends Component
{
    public $sort = 'id', $direction = 'asc', $search = '';
    public $name, $idProveedor, $direccion, $email;
    protected $listeners = ['delete'];

    public function render()
    {
        $proveedores = Provider::where('name', 'like', '%' . $this->search . '%')->orWhere('id', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)->paginate(10);
        return view('livewire.categoria.admin-proveedores',compact('proveedores'));
    }
    public $rules = [
        'name' => 'required|string|min:2|max:90|unique:categories',
        'direccion' => 'required',
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
            Provider::create([
                'name' => $this->name,
                'direccion' => $this->direccion,
                'email'=> $this->email
            ]);
            $this->reset(['name','direccion','email']);
            $this->emit('alert', 'Registro creado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function show(Int $id)
    {
        try {
            $categoria = Provider::findOrFail($id);
            $this->name = $categoria->name;
            $this->direccion = $categoria->direccion;
            $this->email = $categoria->email;
            $this->idProveedor = $categoria->id;
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:90',
            'direccion' => 'required',
        ]);
        try {
            Provider::where('id', $this->idProveedor)->update([
                'name' => $this->name,
                'direccion' => $this->direccion,
                'email'=> $this->email
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
            Provider::destroy($id);
            $this->emit('alert', 'Registro eliminado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
}

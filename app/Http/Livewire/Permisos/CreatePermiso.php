<?php

namespace App\Http\Livewire\Permisos;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use App\Models\Sistema;
use Illuminate\Http\Request;

class CreatePermiso extends Component
{
    public $name,$descripcion,$sistema_id;

    public function render()
    {
        $sistemas = Sistema::all();
        return view('livewire.permisos.create-permiso',compact('sistemas'));
    }


    public $rules = [
        'name' => 'required|string|min:2|max:40|unique:permissions',
        'descripcion' => 'required|string|min:2',
        'sistema_id' => 'required'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function create(Request $request)
    {
        $this->validate();
        try {
            $permisos = new Permission();
            $permisos->description = $this->descripcion;
            $permisos->name = $this->name;
            $permisos->sistema_id = $this->sistema_id;
            $permisos->save();

            $this->emit('alert', 'Registro creado exitosamente!');
            $this->emitTo('permisos.permisos-table', 'render');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
        $this->reset(['name','descripcion','sistema_id']);
    }
}

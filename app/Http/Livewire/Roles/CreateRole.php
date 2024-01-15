<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class CreateRole extends Component
{
    public $name;
    public $permissions=[];

    public $rules = [
        'name' => 'required|string|min:2|max:10|unique:roles'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function create(Request $request)
    {
        $this->validate();
        try {
            $rol = Role::create([
                'name' => $this->name,
            ]);
            $rol->permissions()->sync($this->permissions);
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->emitTo('roles.table-roles', 'render');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
        $this->reset(['name','permissions']);
    }

    public function render()
    {
        $permisos = Permission::all();
        return view('livewire.roles.create-role', compact('permisos'));
    }
}

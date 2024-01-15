<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class TableRoles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render','delete'];
    public $idRol, $name, $permisos = [];
    public $permissions = [];

    public $rules = [
        'name' => 'required|string|min:2|max:10'
    ];

    public function render()
    {
        $roles = Role::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        return view('livewire.roles.table-roles', compact(['roles']));
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

    public function edit(int $idRol)
    {
        $data = Role::findOrFail($idRol);
        //existen 18 permisos para admin
        $rolesWithPermissions  = $data->permissions->pluck('id');
        
        $this->permissions = $rolesWithPermissions;

        $this->idRol = $data->id;
        $this->name = $data->name;
        $this->permisos = Permission::all();
    }

    public function update()
    {

        $this->validate();
        $data = Role::find($this->idRol);
        $permi = $this->permissions;

        $data->update(['name' => $this->name]);
        $data->permissions()->sync($permi);
        $this->emit('alert', 'Registro actualizado exitosamente!');
        $this->reset(['name', 'permissions']);
    }

    public function delete($idRol)
    {
        Role::destroy($idRol);
        $this->emit('alert', 'Registro eliminado exitosamente!');
    }
}

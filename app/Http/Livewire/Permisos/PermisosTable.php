<?php

namespace App\Http\Livewire\Permisos;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use App\Models\Sistema;

class PermisosTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sort = "permissions.id", $direction = "asc";
    protected $listeners = ['render' => 'render', 'delete'];
    public $idPermiso, $name, $descripcion, $sistema_id = "";

    public function render()
    {
        $sistemas  = Sistema::all();

        $permisos = Permission::select('permissions.*', 'sistemas.name as sistema_name')
            ->join('sistemas', 'permissions.sistema_id', '=', 'sistemas.id')
            ->where('permissions.name', 'LIKE', "%{$this->search}%")
            ->orWhere('sistemas.name', 'LIKE', "%{$this->search}%") // Asegúrate de referenciar correctamente la tabla y columna en el filtro
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        // Imprimir la consulta SQL
        return view('livewire.permisos.permisos-table', compact(['permisos', 'sistemas']));
    }



    public $rules = [
        'name' => 'required|string|min:2|max:40',
        'descripcion' => 'required|string|min:2'
    ];

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

    public function edit(int $idPermiso)
    {
        $data = Permission::join('sistemas', 'permissions.sistema_id', '=', 'sistemas.id')
            ->where('permissions.id', $idPermiso)
            ->first(['permissions.*', 'sistemas.id as sistema_id']);

        // Asegurar que se encontró el permiso
        if (!$data) {
            // Manejar el caso en que el permiso no se encuentra, por ejemplo:
            session()->flash('error', 'Permiso no encontrado');
            return;
        }

        // Asignar valores a las propiedades
        $this->idPermiso = $data->id;
        $this->name = $data->name;
        $this->descripcion = $data->description;
        $this->sistema_id = $data->sistema_id;
    }

    public function update()
    {
        $this->validate();
        Permission::where('id', $this->idPermiso)->update([
            'name' => $this->name,
            'description' => $this->descripcion,
            'sistema_id' =>  $this->sistema_id ?? ''
        ]);
        $this->emit('alert', 'Registro actualizado exitosamente!');
        $this->reset(['name']);
    }

    public function delete($idRol)
    {
        Permission::destroy($idRol);
        $this->emit('alert', 'Registro eliminado exitosamente!');
    }
}

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
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render', 'delete'];
    public $idPermiso, $name, $descripcion, $sistema_id = "";

    public function render()
    {
        $sistemas  = Sistema::all();

        $permisos = Permission::with('sistemas')->where('name', 'like', '"%' . $this->search . '%"')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
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
        $data = Permission::findOrFail($idPermiso);
        $idSistema = Permission::with('sistemas')->where('id', $idPermiso)->first();
        $this->sistema_id = $idSistema->sistemas->id ?? '';
        $this->idPermiso = $data->id;
        $this->name = $data->name;
        $this->descripcion = $data->description;
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

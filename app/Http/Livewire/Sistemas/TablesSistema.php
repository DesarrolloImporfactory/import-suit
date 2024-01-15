<?php

namespace App\Http\Livewire\Sistemas;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use App\Models\Sistema;

class TablesSistema extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render','delete'];
    public $idSistema, $name,$tipo,$ruta;

    public $rules = [
        'name' => 'required|string|min:2',
        'tipo' => 'required|string|min:2|max:50',
    ];

    public function render()
    {
        $sistemas = Sistema::where('name', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.sistemas.tables-sistema', compact(['sistemas']));
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

    public function edit(int $idSistema)
    {
        $data = Sistema::findOrFail($idSistema);

        $this->idSistema = $data->id;
        $this->name = $data->name;
        $this->tipo = $data->tipo;
        $this->ruta = $data->ruta;
    }

    public function update()
    {
        $this->validate();
        $data = Sistema::find($this->idSistema);
        
        $data->update([
            'name' => $this->name,
            'tipo' => $this->tipo,
            'ruta' => $this->ruta
        ]);
        $this->emit('alert', 'Registro actualizado exitosamente!');
        $this->reset(['name','tipo','ruta']);
    }

    public function delete($idSistema)
    {
        Sistema::destroy($idSistema);
        $this->emit('alert', 'Registro eliminado exitosamente!');
    }
}

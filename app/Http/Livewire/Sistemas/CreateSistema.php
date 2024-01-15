<?php

namespace App\Http\Livewire\Sistemas;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Sistema;

class CreateSistema extends Component
{
    public $name,$tipo,$ruta;
    public $permissions=[];

    public $rules = [
        'name' => 'required|string|min:2|unique:sistemas',
        'tipo' => 'required|string|min:2|max:50',
    ];

    public function render()
    {
        return view('livewire.sistemas.create-sistema');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function create(Request $request)
    {
        $this->validate();
        try {
            Sistema::create([
                'name' => $this->name,
                'tipo' => $this->tipo,
                'ruta' => $this->ruta,
            ]);
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->emitTo('sistemas.tables-sistema', 'render');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
        $this->reset(['name','tipo','ruta']);
    }

}

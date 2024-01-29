<?php

namespace App\Http\Livewire\Perfiles;

use App\Models\Name;
use App\Models\Perfil;
use App\Models\Sistema;
use App\Models\Suscripcion\Tipo;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PerfilSuscription extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '', $estadoFilter, $dias;
    public $name, $name_id, $sistem, $idUser, $estado, $fecha_fin, $idSus, $estate, $usuarioWithSuscriptions = [];
    public $sort = "id", $direction = "asc";
    public $clientes, $precio;
    public $sistems = [];
    protected $listeners = ['render' => 'render', 'destroy', 'show'];

    public function render()
    {
        $sistemas = Sistema::whereNotIn('id', [2])->get();
        $this->clientes = Name::all();

        $consulta = Perfil::with('names', 'sistemas')
            ->whereHas('names', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('perfils')
                    ->groupBy('name_id');
            });

        if (strlen($this->estadoFilter) > 1) {
            $valor = $this->estadoFilter;
            $consulta->where(function ($query) use ($valor) {
                $query->where('estado', $valor);
            });
        }
        $perfiles = $consulta->paginate(10);
        return view('livewire.perfiles.perfil-suscription', compact('perfiles', 'sistemas'))->extends('adminlte::page')
            ->section('content');
    }
    protected $rules = [
        'name_id' => 'required',
        'sistems' => 'array|required',
        'estado' => 'required',
        'dias' => 'required|numeric'
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

    public function perfilCreate()
    {
        $this->validate([
            'name' => 'required',
            'precio' => 'required|numeric|min:1'
        ]);
        try {
            Name::create([
                'name' => $this->name,
                'precio' => $this->precio
            ]);
            $this->emit('update', $this->clientes);
            $this->reset(['name', 'precio']);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->validate();
        $fechaInicio = Carbon::parse(today()->toDateString())->addDays($this->dias);
        try {
            $existeAsignacion = Perfil::where('name_id', $this->name_id)
                ->whereIn('sistema_id', $this->sistems)
                ->exists();


            if ($existeAsignacion) {
                // El usuario ya tiene una asignación para este sistema, mostrar mensaje de error
                $this->addError('sistems', 'Uno o más sistemas ya están asignados al usuario.');
            } else {
                foreach ($this->sistems as $sistemaId) {
                    Perfil::create([
                        'name_id' => $this->name_id,
                        'sistema_id' => $sistemaId,
                        'estado' => $this->estado,
                        'fecha_inicio' => today()->toDateString(),
                        'fecha_fin' => $fechaInicio->toDateString(),
                        'dias' => $this->dias
                    ]);
                }
                $this->sistems = [];
                $this->emit('alert', 'Registro creado exitosamente!');
                $this->reset(['name_id', 'sistem', 'estado', 'fecha_fin']);
            }
        } catch (\Exception $th) {
            $this->emit('alert', $th->getMessage());
        }
    }

    public function resetear()
    {
        $this->name = "";
        $this->emit('modal', 'Registro creado exitosamente!');
    }

    public function show(Int $id)
    {
        try {
            $cliente = Perfil::findOrFail($id);
            $usuario = Name::findOrFail($cliente->name_id);
            //para los selects
            $data = [
                'estado' => $cliente->estado,
            ];
            $this->name_id = $cliente->name_id;
            $this->fecha_fin = $cliente->fecha_fin;
            $this->dias = $cliente->dias;
            $this->idSus = $cliente->id;
            $this->idUser = $usuario->id;
            $this->usuarioWithSuscriptions = $usuario->perfil->pluck('sistema_id');
            $this->emit('estado', $data);
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }

    public function update()
    {

        try {
            $this->validate([
                'name_id' => 'required',
                'usuarioWithSuscriptions' => 'array|required',
                'estado' => 'required',
            ]);
            $usuario = Name::findOrFail($this->idUser);
            $usuario->perfil()->delete();
            foreach ($this->usuarioWithSuscriptions  as $sistema) {
                $data = [
                    'name_id' => $this->name_id,
                    'sistema_id' => $sistema,
                    'estado' => $this->estado,
                    'fecha_inicio' => today()->toDateString(),
                    'fecha_fin' => Carbon::parse(today()->toDateString())->addDays($this->dias),
                    'dias' => $this->dias
                ];
                Perfil::create($data);
            }
            $this->emit('alert', 'Suscripción actualizado exitosamente!');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
        $this->reset(['name', 'sistem', 'estado', 'fecha_fin', 'idSus']);
    }

    public function destroy(Int $id)
    {
        Perfil::where('name_id', $id)->delete();
        // Suscripcion::destroy($id);
        $this->emit('alert', 'Suscripción eliminada exitosamente!');
    }
}

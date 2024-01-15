<?php

namespace App\Http\Livewire\Suscripcion;

use App\Models\Sistema;
use App\Models\Suscripcion\Suscripcion;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Suscripcion\Tipo;
use App\Models\User;
use Carbon\Carbon;

class UserSuscription extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '', $estadoFilter,$dias;
    public $cliente, $sistem,$idUser, $estado,$fecha_fin, $idSus, $estate, $usuarioWithSuscriptions = [];
    public $sort = "id", $direction = "asc";
    public $sistems = [];
    protected $listeners = ['render' => 'render', 'destroy', 'show'];

    public function render()
    {
        $sistemas = Sistema::whereNotIn('id', [2])->get();

        $clientes = User::whereHas("roles", function ($q) {
            $q->where("name", "Client")
                ->orWhere("name", "Alumno");
        })->get();

        $consulta = Suscripcion::with('usuarios', 'tipos', 'sistemas')
            ->whereHas('usuarios', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('suscripcions')
                    ->groupBy('usuario_id');
            });

        if (strlen($this->estadoFilter) > 1) {
            $valor = $this->estadoFilter;
            $consulta->where(function ($query) use ($valor) {
                $query->where('estado', $valor);
            });
        }
        $suscripciones = $consulta->paginate(10);
        return view('livewire.suscripcion.user-suscription', compact('suscripciones', 'sistemas','clientes'))->extends('adminlte::page')
            ->section('content');
    }

    protected $rules = [
        'cliente' => 'required',
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
            foreach ($this->sistems as $sistemaId) {
                Suscripcion::create([
                    'usuario_id' => $this->cliente,
                    'sistema_id' => $sistemaId,
                    'estado' => $this->estado,
                    'fecha_inicio' =>today()->toDateString(),
                    'fecha_fin' => $fechaInicio->toDateString(),
                    'dias' => $this->dias
                ]);
            }
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->reset(['cliente', 'sistem','estado','fecha_fin']);
        } catch (\Exception $th) {
            $this->emit('alert', $th->getMessage());
        }
    }

    public function resetear()
    {
        $this->cliente = "";
        $this->emit('modal', 'Registro creado exitosamente!');
    }

    public function show(Int $id)
    {
        try {
            $cliente = Suscripcion::findOrFail($id);
            $usuario = User::findOrFail($cliente->usuario_id);
            //para los selects
            $data = [
                'cliente' => $cliente->usuario_id,
                'estado' => $cliente->estado,
            ];
            $this->fecha_fin = $cliente->fecha_fin;
            $this->dias = $cliente->dias;
            $this->idSus = $cliente->id;
            $this->idUser = $usuario->id;
            $this->usuarioWithSuscriptions = $usuario->suscripcion->pluck('sistema_id');
            $this->emit('estado', $data);
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }

    public function update()
    {

        try {
            $this->validate([
                'cliente' => 'required',
                'usuarioWithSuscriptions' => 'array|required',
                'estado' => 'required',
            ]);
            $usuario = User::findOrFail($this->idUser);
            $usuario->suscripcion()->delete();
            foreach ($this->usuarioWithSuscriptions  as $sistema) {
                $data = [
                    'usuario_id' => $this->cliente,
                    'sistema_id' => $sistema,
                    'estado' => $this->estado,
                    'fecha_inicio' => today()->toDateString(),
                    'fecha_fin' => Carbon::parse(today()->toDateString())->addDays($this->dias),
                    'dias' => $this->dias
                ];
                Suscripcion::create($data);
            }
            $this->emit('alert', 'Suscripción actualizado exitosamente!');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
        $this->reset(['cliente', 'sistem','estado','fecha_fin', 'idSus']);
    }

    public function destroy(Int $id)
    {
        Suscripcion::where('usuario_id', $id)->delete();
        // Suscripcion::destroy($id);
        $this->emit('alert', 'Suscripción eliminada exitosamente!');
    }
}

<?php

namespace App\Http\Livewire\User;

use App\Models\Course;
use App\Models\Name;
use App\Models\Perfil;
use App\Models\Suscripcion\Suscripcion;
use Livewire\Component;
use App\Models\User;
use App\Notifications\SendPassword;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;

class CreateUser extends Component
{

    public $email, $name, $password, $rol, $url, $perfil;

    protected $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'rol' => 'required',
        'url' => 'nullable|url',
        'perfil' => 'nullable'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function createUser()
    {

        $this->validate();
        try {
            $usuario = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'url' => $this->url,
                'perfil_id' => $this->perfil,
                'password' => md5($this->password)
            ])->assignRole($this->rol);
            $usuario->notify(new SendPassword($this->password));

            if ($this->perfil) {
                if ($this->suscripcion($this->perfil, $usuario->id)) {
                    $this->emit('alert', 'Registro creado con suscripciones exitosamente!');
                }
            } else {
                $this->emit('alert', 'Registro creado exitosamente!');
            }
            $this->emitTo('user.table-users', 'render');
        } catch (\Exception $th) {
            dd('alert', $th->getMessage());
        }

        $this->reset(['name', 'email', 'password', 'rol']);
    }

    public function suscripcion($perfil, $usuario)
    {
        $suscripciones = Perfil::where('name_id', $perfil)->get();
        $conteoInserciones = 0;

        foreach ($suscripciones as $suscripcion) {
            if ($suscripcion->sistemas->tipo == 'curso') {
                $curso = Course::where('title', $suscripcion->sistemas->name)->first(); // Obtener el objeto Course
                if ($curso) {
                    $curso->students()->attach(auth()->user()->id);
                }
            }
        }

        foreach ($suscripciones as $suscripcion) {
            $resultado = Suscripcion::create([
                'usuario_id' => $usuario,
                'sistema_id' => $suscripcion->sistema_id,
                'estado' => $suscripcion->estado,
                'fecha_fin' => $suscripcion->fecha_fin,
                'dias' =>  $suscripcion->dias
            ]);

            if ($resultado) {
                $conteoInserciones++;
            }
        }
        if ($conteoInserciones == count($suscripciones)) {
            return true;
        } else {
            return false;
        }
    }

    public function render()
    {
        $roles = Role::get();
        $perfiles = Name::all();
        return view('livewire.user.create-user', compact('roles', 'perfiles'));
    }
}

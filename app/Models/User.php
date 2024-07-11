<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Suscripcion\Suscripcion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\VerifyEmails;
use App\Notifications\UserResetPassword;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use function Illuminate\Events\queueable;

class User extends Authenticatable
{
    use Billable;
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password', 'url',
        'perfil_id'
    ];

    protected static function booted(): void
    {
        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Verifica si la contraseña dada coincide con la almacenada como MD5.
     *
     * @param string $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return Hash::check($password) === $this->password;
    }

    public function suscripcion()
    {
        return $this->hasMany(Suscripcion::class, 'usuario_id', 'id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmails);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function favoritos()
    {
        return $this->hasMany(Favorite::class, 'product_id', 'id');
    }
}
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

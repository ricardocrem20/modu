<?php

namespace Ricardo\Modu\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Ricardo\Modu\Traits\UserTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_identificacion',
        'identificacion',
        'nombre',
        'nombres',
        'apellidos',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeUsersTipoRole($query, $slug)
    {
        return $query
            ->select(
                'users.id',
                'users.tipo_identificacion',
                'users.identificacion',
                'users.nombre',
                'users.email',
                'users.created_at'
            )
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->join('role_tipo_role', 'role_tipo_role.role_id', 'roles.id')
            ->join('tipo_role', 'tipo_role.id', 'role_tipo_role.tipo_role_id') 
            ->where('tipo_role.slug', $slug)
            ->get();
    }
}

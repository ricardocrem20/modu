<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table 	= 'role_user';
    protected $fillable = ['role_id', 'user_id'];

    public function scopeRolesUser($query, $idUser) {
    	return $query
    		->select('role_id')
    		->where('user_id', $idUser)
    		->get();
    }

    public function scopeExisteRoleUser($query, $idRole, $idUser)
    {
        return $query
            ->where('role_id', $idRole)
            ->where('user_id', $idUser)
            ->exists();
    }

    public function scopeRoleUser($query, $idRole, $idUser)
    {
    	return $query
    		->select('id')
    		->where('role_id', $idRole)
    		->where('user_id', $idUser)
    		->get();
    }

    public function scopeModulosUser($query, $idUser)
    {
        return $query 
            ->select(
                'modulos.*'
            )
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->join('modulo_role', 'modulo_role.role_id', 'roles.id')
            ->join('modulos', 'modulos.id', 'modulo_role.modulo_id')
            ->where('role_user.user_id', $idUser)
            ->distinct('modulos.id')
            ->orderBy('modulos.orden')
            ->get();
    }
}

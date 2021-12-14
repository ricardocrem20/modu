<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloRole extends Model
{
    use HasFactory;

    protected $table 	= 'modulo_role';
    protected $fillable = ['modulo_id', 'role_id'];

    public function scopeExisteRoleModulo($query, $idRole, $idModulo)
    {
    	return $query
    		->where('role_id', $idRole)
    		->where('modulo_id', $idModulo)
    		->exists();
    }

    public function scopeRoleModulo($query, $idRole, $idModulo)
    {
        return $query
            ->select('id')
            ->where('role_id', $idRole)
            ->where('modulo_id', $idModulo)
            ->get();
    }

    public function scopeValidarModulo($query, $idRole, $idModulo)
    {
        return $query
            ->where('role_id', $idRole)
            ->where('modulo_id', $idModulo)
            ->exists();
    }

}

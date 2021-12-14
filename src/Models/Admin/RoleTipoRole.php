<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTipoRole extends Model
{
    use HasFactory;
    protected $table = 'role_tipo_role';

    public function scopeExisteTipoRole($query, $idRole, $idTipoRole)
    {
        return $query
            ->where('role_id', $idRole)
            ->where('tipo_role_id', $idTipoRole)
            ->exists();
    }

    public function scopeRoleTipoRole($query, $idRole, $idTipoRole)
    {
        return $query
            ->select('id')
            ->where('role_id', $idRole)
            ->where('tipo_role_id', $idTipoRole)
            ->get();
    }
}

<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRole extends Model
{
    use HasFactory;
    protected $table = 'tipo_role';

    public function scopeSelectTiposRoles($query) 
    {
        return $query
            ->select(
                'id as value',
                'tipo_role as text'
            )
            ->get();
    }

    public function scopeTiposRoles($query, $idRole) 
    {
        return $query
            ->select('tipo_role.id')
            ->join('role_tipo_role', 'role_tipo_role.tipo_role_id', 'tipo_role.id')
            ->where('role_tipo_role.role_id', $idRole)
            ->get();
    }
}

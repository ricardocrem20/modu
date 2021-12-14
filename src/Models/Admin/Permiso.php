<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $fillable = [
    	'permiso',
    	'slug',
    	'descripcion',
    	'area_id'
    ];

    public function scopeModulo($query, $permiso)
    {
        return $query
            ->select('modulos.id')
            ->join('areas', 'areas.id', 'permisos.area_id')
            ->join('modulos', 'modulos.id', 'areas.modulo_id')
            ->where('permisos.slug', $permiso)
            ->get()
            ->first();
    }

    public function scopeValidarPermiso($query, $permiso, $idUser) {
        return $query
            ->join('permiso_user', 'permiso_user.permiso_id', 'permisos.id')
            ->where('permisos.slug', $permiso)
            ->where('permiso_user.user_id', $idUser)
            ->exists();
    }
}

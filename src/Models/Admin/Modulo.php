<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
    	'modulo',
    	'icono',
    	'url',
        'orden',
        'descripcion'
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function scopeSelectModulos($query) 
    {
        return $query
            ->select(
                'modulos.id as value',
                'modulos.modulo as text'
            )
            ->join('areas', 'areas.modulo_id', 'modulos.id')
            ->get();
    }

    public function scopeModulosRole($query, $idRole)
    {
        return $query
            ->select(
                'modulos.id',
                'modulos.modulo',
                'activo'
            )
            ->join('modulo_role', 'modulo_role.modulo_id', 'modulos.id')
            ->where('modulo_role.role_id', $idRole)
            ->get();
    }
}

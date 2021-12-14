<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
    	'area',
    	'icono',
    	'url',
        'orden',
        'menu',
    	'descripcion',
    	'modulo_id'
    ];

    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }

    public function scopeAreasModuloMenu($query, $idModulo)
    {
        return $query 
            ->select(
                'id',
                'area',
                'icono',
                'url',
                'orden'
            )
            ->where('modulo_id', $idModulo)
            ->where('menu', true)
            ->orderBy('orden')
            ->get();
    }

    public function scopeAreasModulo($query, $idModulo)
    {
        return $query
            ->where('modulo_id', $idModulo)
            ->orderBy('orden')
            ->get();
    }
}

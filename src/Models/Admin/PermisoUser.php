<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoUser extends Model
{
    use HasFactory;

    protected $table 	= 'permiso_user';
    protected $fillable = ['permiso_id', 'user_id'];

    public function scopeExistePermisoUser($query, $idPermiso, $idUser)
    {
    	return $query
    		->where('permiso_id', $idPermiso)
    		->where('user_id', $idUser)
    		->exists();
    }

    public function scopePermisoUser($query, $idPermiso, $idUser)
    {
        return $query
            ->select('id')
            ->where('permiso_id', $idPermiso)
            ->where('user_id', $idUser)
            ->get()
            ->first();
    }
}

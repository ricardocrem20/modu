<?php

namespace Ricardo\Modu\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

   	protected $fillable = [
   		'role',
   		'slug',
   		'descripcion'
   	];

   	public function scopeSelectRoles($query, $idTipo) {
   		return $query
  			->select(
  				'roles.id as value',
  				'roles.role as text'
  			)
        ->join('role_tipo_role', 'role_tipo_role.role_id', 'roles.id')
        ->where('role_tipo_role.tipo_role_id', $idTipo)
        ->distinct()
  			->get();
   	}

    public function scopeIdRoleSlug($query, $slug) {
      return $query
        ->where('slug', $slug)
        ->value('id');
    }
}

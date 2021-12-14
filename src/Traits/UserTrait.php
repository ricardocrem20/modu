<?php
namespace Ricardo\Modu\Traits;
use Ricardo\Modu\Models\Admin\Permiso;
use Ricardo\Modu\Models\Admin\ModuloRole;

trait UserTrait {

	public function roles()
    {
        return $this->belongsToMany('Ricardo\Modu\Models\Admin\Role', 'role_user');
    }

    public function tienePermiso($permiso, $idUser) {
        $modulo         = Permiso::Modulo($permiso);
        $moduloValidado = false;
        foreach($this->roles as $role) {
            $validador = ModuloRole::ValidarModulo($role->id, $modulo->id);
            if($validador) {
                $moduloValidado = true;
            }
        }
        if($moduloValidado) {
            $validador = Permiso::ValidarPermiso($permiso, $idUser);
        }
        return $validador;
    }
}
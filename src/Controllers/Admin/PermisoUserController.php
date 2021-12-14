<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\PermisoUser;
use Ricardo\Modu\Models\Admin\Area;
use Illuminate\Http\Request;

class PermisoUserController extends Controller
{
    public function store(Request $request)
    {
        $existePermisoUser = PermisoUser::ExistePermisoUser($request->permiso_id, $request->user_id);
        if ($existePermisoUser) {
            $permisoUser = PermisoUser::PermisoUser($request->permiso_id, $request->user_id);
            $permisoUser->destroy($permisoUser->id);
            return response()->json(['message' => 'El permiso fue quitado correctamente']);
        }else {
            $permisoUser = new PermisoUser();
            $permisoUser->permiso_id = $request->permiso_id;
            $permisoUser->user_id    = $request->user_id;
            $permisoUser->save();
            return response()->json(['message' => 'El permiso fue asignado correctamente']); 
        }
    }

    public function asignarTodosPermisos(Request $request)
    {
        $permisos = Area::find($request->area_id)->permisos;
        foreach($permisos as $permiso) {
            $existePermisoUser = PermisoUser::ExistePermisoUser($permiso->id, $request->user_id);
            if (!$existePermisoUser) {
                $permisoUser = new PermisoUser();
                $permisoUser->permiso_id = $permiso->id;
                $permisoUser->user_id    = $request->user_id;
                $permisoUser->save();
            }
        }
        return response()->json(['message' => 'Los permisos fueron asignados correctamente']);
    }

    public function quitarTodosPermisos(Request $request)
    {
        $permisos = Area::find($request->area_id)->permisos;
        foreach($permisos as $permiso) {
            $existePermisoUser = PermisoUser::ExistePermisoUser($permiso->id, $request->user_id);
            if ($existePermisoUser) {
                $permisoUser = PermisoUser::PermisoUser($permiso->id, $request->user_id);
                $permisoUser->destroy($permisoUser->id);
            }
        }
        return response()->json(['message' => 'Los permisos fueron quitados correctamente']);
    }
}

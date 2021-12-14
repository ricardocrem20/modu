<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function asignarRoles(Request $request)
    {
        $roles = [];
        $rolesUser = RoleUser::RolesUser($request->id);
        foreach ($rolesUser as $roleUser) {
            array_push($roles, $roleUser->role_id);   
        }

        $eliminar = array_diff($roles, $request->roles);
        $crear = array_diff($request->roles, $roles);

        foreach ($eliminar as $key) {
            $roleUser = RoleUser::RoleUser($key, $request->id)->first();
            RoleUser::destroy($roleUser->id);
        }

        foreach ($crear as $key) {
            $roleUser = new RoleUser();
            $roleUser->role_id = $key;
            $roleUser->user_id = $request->id;
            $roleUser->save();
        }
        return response()->json(['message' => 'Los roles fueron asignados correctamente']);
    }
}

<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\Role;
use Ricardo\Modu\Models\Admin\Modulo;
use Ricardo\Modu\Models\Admin\ModuloRole;
use Ricardo\Modu\Models\Admin\TipoRole;
use Ricardo\Modu\Models\Admin\RoleTipoRole;
use Illuminate\Http\Request;
use Ricardo\Modu\Requests\Admin\RoleRequest;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tieneAcceso', 'listar_roles');

        $roles = Role::all();
        foreach($roles as $role) {
            $role->modulos = Modulo::ModulosRole($role->id);
        }
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Gate::authorize('tieneAcceso', 'crear_roles');

        $role = Role::create($request->all());
        foreach($request->tipos_roles as $tipoRole) {
            $existeTipoRole = RoleTipoRole::ExisteTipoRole($role->id, $tipoRole);
            if(!$existeTipoRole) {
                $roleTipoRole = new RoleTipoRole();
                $roleTipoRole->role_id      = $role->id; 
                $roleTipoRole->tipo_role_id = $tipoRole;
                $roleTipoRole->save();
            }
        }
        
        if($request->filled('modulos')) {
            foreach($request->modulos as $modulo) {
                $existeRoleModulo = ModuloRole::ExisteRoleModulo($role->id, $modulo);
                if (!$existeRoleModulo) {
                    $moduloRole = new ModuloRole();
                    $moduloRole->role_id   = $role->id;
                    $moduloRole->modulo_id = $modulo;
                    $moduloRole->save();
                }
            }
        }
        return response()->json(['message' => 'El rol fue creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('tieneAcceso', 'obtener_rol');

        $role = Role::find($id);
        $role->modulos     = $this->getArrayModulos($role->id);
        $role->tipos_roles = $this->getArrayTiposRoles($role->id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        Gate::authorize('tieneAcceso', 'editar_roles');

        $role = Role::find($id);
        $role->update($request->all());

        $modulos  = $this->getArrayModulos($role->id); 
        $eliminar = array_diff($modulos, $request->modulos);
        $crear    = array_diff($request->modulos, $modulos);

        foreach ($eliminar as $key) {
            $moduleRole = ModuloRole::RoleModulo($role->id, $key)->first();
            ModuloRole::destroy($moduleRole->id);
        }

        foreach ($crear as $key) {
            $moduloRole = new ModuloRole();
            $moduloRole->role_id   = $role->id;
            $moduloRole->modulo_id = $key;
            $moduloRole->save();
        }

        $tiposRoles = $this->getArrayTiposRoles($role->id);
        $eliminar   = array_diff($tiposRoles, $request->tipos_roles);
        $crear      = array_diff($request->tipos_roles, $tiposRoles);

        foreach ($eliminar as $key) {
            $roleTipoRole = RoleTipoRole::RoleTipoRole($role->id, $key)->first();
            RoleTipoRole::destroy($roleTipoRole->id);
        }

        foreach ($crear as $key) {
            $roleTipoRole = new RoleTipoRole();
            $roleTipoRole->role_id      = $role->id; 
            $roleTipoRole->tipo_role_id = $key;
            $roleTipoRole->save();
        }        

        return response()->json(['message' => 'El rol fue editado correctamente']);
    }

    public function destroy($id)
    {
        Gate::authorize('tieneAcceso', 'eliminar_roles');

        $role = Role::find($id);
        try{
            $role->delete();
            return response()->json([
                'message' => 'El rol fue eliminado correctamente'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'El rol no se pudo eliminar, debido a que ya cuenta con usuarios o modulos asignados'
            ], 422);
        }
    }

    public function selectRoles($idTipo) 
    {
        $selectRoles = Role::selectRoles($idTipo);
        return response()->json($selectRoles);
    }

    private function getArrayModulos($idRole)
    {
        $modulos = [];
        $modulosRole = Modulo::ModulosRole($idRole);
        foreach ($modulosRole as $moduloRole) {
            array_push($modulos, $moduloRole->id);   
        }
        return $modulos;
    }

    private function getArrayTiposRoles($idRole)
    {
        $tiposRoles = [];
        $rolesTiposRoles = TipoRole::TiposRoles($idRole);
        foreach ($rolesTiposRoles as $roleTipoRole) {
            array_push($tiposRoles, $roleTipoRole->id);   
        }
        return $tiposRoles;
    }
}

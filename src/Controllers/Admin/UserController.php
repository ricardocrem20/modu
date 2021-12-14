<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\User;
use Ricardo\Modu\Models\Admin\Modulo;
use Ricardo\Modu\Models\Admin\RoleUser;
use Ricardo\Modu\Models\Admin\Area;
use Ricardo\Modu\Models\Admin\PermisoUser;
use Illuminate\Http\Request;
use Ricardo\Modu\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['nombre']   = $request->nombres.' '.$request->apellidos;
        $request['password'] = bcrypt($request->identificacion);
        $user = User::create($request->all());
        $accessToken = $user->createToken('CD08')->accessToken;
        if ($request->filled('roles')) {
            foreach ($request->roles as $role) {
                $roleUser = new RoleUser();
                $roleUser->role_id = $role;
                $roleUser->user_id = $user->id;
                $roleUser->save();
            }
        }
        return response()->json([
            'user'    => $user->only('id'),
            'message' => 'El usuario fue creado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->roles = $this->getArrayRoles($user->id);
        return response()->json($user ,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $request['nombre']   = $request->nombres.' '.$request->apellidos;
        $request['password'] = bcrypt($request->identificacion);
        $user = User::find($id);
        $user->update($request->all());
        return response()->json(['message' => 'El usuario fue editado correctamente']);
    }

    public function areasPermisosUser($idUser)
    {
        $modulos = RoleUser::ModulosUser($idUser);
        foreach ($modulos as $modulo) {
            $modulo->areas = Modulo::find($modulo->id)->areas;
            foreach ($modulo->areas as $area) {
                $cant_activos    = 0;
                $cant_desactivos = 0;
                $area->permisos = Area::find($area->id)->permisos;
                foreach ($area->permisos as $permiso) {
                    $permiso->activo = PermisoUser::ExistePermisoUser($permiso->id, $idUser);
                    if ($permiso->activo) {
                        $cant_activos ++;
                    }else{
                        $cant_desactivos ++;
                    }
                }
                $area->cant_activos    = $cant_activos;
                $area->cant_desactivos = $cant_desactivos;
            }
        }
        return response()->json($modulos, 200);
    }

    public function menuUser()
    {
        $modulos = RoleUser::ModulosUser(Auth('api')->user()->id);
        foreach($modulos as $modulo) {
            $modulo->areas = Area::AreasModuloMenu($modulo->id);
        }
        return response()->json($modulos, 200);
    }

    public function editarEmail(UserEmailRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['message' => 'El correo fue editado correctamente']);
    }

    public function editarPassword(Request $request, User $user)
    {
        if (Hash::check($request->actual_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['message' => 'La contraseña fue edita correctamente']);
        }else{
            return response()->json([
                'error'=> 'La contraseña actual es incorrecta'
            ], 422);
        }

        $user->update($request->all());
        return response()->json(['message' => 'El correo fue editado correctamente']);
    }

    public function editarFotoPerfil(Request $request)
    {
        $user = Auth('api')->user();
        $path = $this->subirImagen($request, $user->id);
        if ($path) {
            $dominio = $_SERVER['SERVER_NAME'];
            $user->foto_perfil = 'http://' . $dominio . '/' . $path;
            $user->save();
            return response()->json([
                'message' => 'La imagen se cambio correctamente.',
                'ruta'    => $user->foto_perfil
            ]);
        } else {
            return response()->json([
                'error' => 'Verifica que el arvhico sea una imagen.'
            ], 422);
        }
    }

    public function usersAdministrativos()
    {
        $usersAdministrativos = User::UsersTipoRole('administrativos');
        return response()->json($usersAdministrativos);
    }

    private function subirImagen($request, $idUser)
    {
        $extension = $request->file->getClientOriginalExtension();
        if ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg') {
            $path = $request->file('file')->store('public/img/perfiles/'.$idUser);
            $url = str_replace("public/", "storage/", $path);
            return $url;
        } else {
            return false;
        }
    }

    private function getArrayRoles($idUser)
    {
        $roles = [];
        $rolesUser = RoleUser::RolesUser($idUser);
        foreach ($rolesUser as $roleUser) {
            array_push($roles, $roleUser->role_id);   
        }
        return $roles;
    }
}

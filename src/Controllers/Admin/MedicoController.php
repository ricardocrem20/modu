<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\User;
use Ricardo\Modu\Models\Admin\Role;
use Ricardo\Modu\Models\Admin\RoleUser;
use Ricardo\Modu\Models\Admin\SedeUser;
use Ricardo\Modu\Models\Admin\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = User::UsersRole('medico');
        return response()->json($medicos ,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['nombre']   = $request->nombres.' '.$request->apellidos;
        $request['password'] = bcrypt($request->identificacion);
        $user = User::create($request->all());
        $accessToken = $user->createToken('SK2021')->accessToken;

        foreach ($request->roles as $role) {
            $roleUser = new RoleUser();
            $roleUser->role_id = $role;
            $roleUser->user_id = $user->id;
            $roleUser->save();
        }

        foreach($request->sedes as $sede) {
            $sedeUser = new SedeUser();
            $sedeUser->user_id = $user->id;
            $sedeUser->sede_id = $sede;
            $sedeUser->save();
        }

        foreach($request->profesions as $id) {
            $profesion = new Profesion();
            $profesion->cup_id = $id;
            $profesion->user_id = $user->id;
            $profesion->save();
        }

        return response()->json(['created' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesions      = [];
        $sedes           = [];
        $medico = User::find($id);
        $profesionesUser = Profesion::ProfesionsUser($medico->id);
        $sedesUser       = SedeUser::SedesUser($medico->id);

        foreach($profesionesUser as $profesion) {
            array_push($profesions, $profesion->cup_id);
        }

        foreach($sedesUser as $sede) {
            array_push($sedes, $sede->sede_id);
        }

        $medico->profesions = $profesions;
        $medico->sedes      = $sedes;

        return response()->json($medico ,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['nombre']   = $request->nombres.' '.$request->apellidos;
        $request['password'] = bcrypt($request->identificacion);
        $medico = User::find($id);
        $medico->update($request->all());

        $sedes    = $this->getArraySedes($medico->id);
        $eliminar = array_diff($sedes, $request->sedes);
        $crear    = array_diff($request->sedes, $sedes);

        foreach ($eliminar as $key) {
            $sedeUser = SedeUser::SedeUser($medico->id, $key);
            SedeUser::destroy($sedeUser->id);
        }

        foreach ($crear as $key) {
            $sedeUser = new SedeUser();
            $sedeUser->sede_id = $key;
            $sedeUser->user_id = $medico->id;
            $sedeUser->save();
        }

        $errores = [];
        $profesiones = $this->getArrayProfesiones($medico->id);
        $crear    = array_diff($request->profesions, $profesiones);
        $eliminar = array_diff($profesiones, $request->profesions);

        foreach ($crear as $key) {
            $profesionUser = new Profesion();
            $profesionUser->cup_id  = $key;
            $profesionUser->user_id = $medico->id;
            $profesionUser->save();
        }

        foreach ($eliminar as $key) {
            $profesionUser = Profesion::ProfesionUser($medico->id, $key);
            try {
                SedeUser::destroy($profesionUser->id);
            } 
            catch (Exception $e) {
                array_push($errores, ['error' => $profesionUser]);
            }
        }

        return response()->json([
            'errores' => $errores,
            'updated' => true
        ], 200);
    }

    private function getArraySedes($idMedico)
    {
        $sedes     = [];
        $sedesUser = SedeUser::SedesUser($idMedico);
        foreach ($sedesUser as $sede) {
            array_push($sedes, $sede->sede_id);   
        }
        return $sedes;
    }

    private function getArrayProfesiones($idMedico)
    {
        $profesiones     = [];
        $profesionesUser = Profesion::ProfesionsUser($idMedico);
        foreach ($profesionesUser as $profesion) {
            array_push($profesiones, $profesion->cup_id);   
        }
        return $profesiones;
    }
}

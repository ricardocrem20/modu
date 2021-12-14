<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\Permiso;
use Illuminate\Http\Request;
use Ricardo\Modu\Requests\Admin\PermisoRequest;
use Illuminate\Support\Facades\Gate;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::all();
        return response()->json($permisos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermisoRequest $request)
    {
        Gate::authorize('tieneAcceso', 'crear_permisos');

        Permiso::create($request->all());
        return response()->json(['message' => 'El permiso fue creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('tieneAcceso', 'obtener_permiso');

        $permiso = Permiso::find($id);
        return response()->json($permiso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(PermisoRequest $request, $id)
    {
        Gate::authorize('tieneAcceso', 'editar_permisos');

        $permiso = Permiso::find($id);
        $permiso->update($request->all());
        return response()->json(['message' => 'El permiso fue editado correctamente']);
    }

    public function destroy($id)
    {
        Gate::authorize('tieneAcceso', 'eliminar_permisos');

        $permiso = Permiso::find($id);
        try{
            $permiso->delete();
            return response()->json([
                'message' => 'El permiso fue eliminado correctamente'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'El permiso no se pudo eliminar, debido a que ya cuenta con usuarios asignados'
            ], 422);
        }
    }
}

<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\Area;
use Illuminate\Http\Request;
use Ricardo\Modu\Requests\Admin\AreaRequest;
use Illuminate\Support\Facades\Gate;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tieneAcceso', 'listar_areas');

        $areas = Area::all();
        return response()->json($areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        Gate::authorize('tieneAcceso', 'crear_areas');

        Area::create($request->all());
        return response()->json([
            'message' => 'El area fue creada correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('tieneAcceso', 'obtener_area');

        $area = Area::find($id);
        return response()->json($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        Gate::authorize('tieneAcceso', 'editar_areas');

        $area = Area::find($id);
        $area->update($request->all());
        return response()->json([
            'message' => 'El area fue editada correctamente'
        ]);
    }

    public function destroy($id)
    {
        Gate::authorize('tieneAcceso', 'eliminar_areas');

        $area = Area::find($id);
        try{
            $area->delete();
            return response()->json([
                'message' => 'El area fue eliminada correctamente'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'El area no se pudo eliminar, debido a que ya cuenta con permisos asignados'
            ], 422);
        }
    }

    public function areasModulo($idModulo)
    {
        $areas = Area::AreasModulo($idModulo);
        return response()->json($areas);
    }

    public function permisosArea($idArea)
    {
        $permisos = Area::find($idArea)->permisos;
        return response()->json($permisos);
    }
}

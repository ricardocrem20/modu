<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\Modulo;
use Illuminate\Http\Request;
use Ricardo\Modu\Requests\Admin\ModuloRequest;
use Illuminate\Support\Facades\Gate;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('tieneAcceso', 'listar_modulos');

        $modulos = Modulo::orderBy('orden')->get();
        foreach ($modulos as $modulo) {
            $modulo->areas = Modulo::find($modulo->id)->areas;
        }
        return response()->json($modulos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuloRequest $request)
    {
        Gate::authorize('tieneAcceso', 'crear_modulos');

        Modulo::create($request->all());
        return response()->json(['message' => 'El módulo fue creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('tieneAcceso', 'obtener_modulo');

        $modulo = Modulo::find($id);
        return response()->json($modulo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(ModuloRequest $request, $id)
    {
        Gate::authorize('tieneAcceso', 'editar_modulos');

        $modulo = Modulo::find($id);
        $modulo->update($request->all());
        return response()->json(['message' => 'El módulo fue editado correctamente']);
    }

    public function destroy($id)
    {
        Gate::authorize('tieneAcceso', 'eliminar_modulos');

        $modulo = Modulo::find($id);
        try{
            $modulo->delete();
            return response()->json(['message' => 'El módulo fue eliminado correctamente']);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'El módulo no se pudo eliminar, debido a que ya cuenta con areas o roles asignados'
            ], 422);
        }
    }

    public function selectModulos()
    {
        $selectModulos = Modulo::selectModulos();
        return response()->json($selectModulos);
    }
}

<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\ModuloRole;
use Illuminate\Http\Request;

class ModuloRoleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ModuloRole::create($request->all());
        return response()->json(['created' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ModuloRole  $moduloRole
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $moduloRole = ModuloRole::find($id);
        $moduloRole->delete();
        return response()->json(['deleted' => true], 200);
    }
}

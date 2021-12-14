<?php

namespace Ricardo\Modu\Controllers\Admin;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\Admin\TipoRole;
use Illuminate\Http\Request;

class TipoRoleController extends Controller
{
    public function selectTiposRoles()
    {
        $tiposRoles = TipoRole::SelectTiposRoles();
        return response()->json($tiposRoles);
    }
}

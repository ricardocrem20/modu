<?php

namespace Ricardo\Modu\Controllers\ApiAuth;

use Ricardo\Modu\Controllers\Controller;
use Ricardo\Modu\Models\User;
use Ricardo\Modu\Models\Admin\SedeUser;
use Ricardo\Modu\Models\Admin\Role;
use Illuminate\Http\Request;
use Ricardo\Modu\Requests\ApiAuth\RegistroRequest;
use Ricardo\Modu\Requests\ApiAuth\LoginRequest;

class AuthController extends Controller
{
    public function registro(RegistroRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        $accessToken = $user->createToken('CD08')->accessToken;
        return response()->json([
            'message' => 'El usuario fue creado correctamente',
            'user' => $user->only('id','name','email', 'foto_perfil'), 
            'token' => $accessToken
        ]);
    }

    public function login(Request $request)
    {
        $request = $request->validate([
            'email'    => 'required|email|max:60',
            'password' => 'required|string|min:6|max:60'
        ]);

        if(Auth()->attempt($request)) { 
            $user = Auth()->user();
            $accessToken =  $user->createToken('CD08')->accessToken;

            return response()->json([
                'user' => $user->only('id','nombre','email', 'foto_perfil'), 
                'token' => $accessToken
            ]);
        }else{ 
            return response()->json([
                'error'=>'Credenciales Invalidas'
            ], 401); 
        }
    }

    public function logout(Request $request)
    {
        $user = Auth('api')->user();
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Se ha cerrado la sesión correctamente'
        ]);
    }

    public function user()
    {
        $user = Auth()->user();
        return response()->json(['user' => $user]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    function login(Request $request){
        $email=$request->email;
        $password=$request->password;
        $user = User::where('email', $email)->first();
        if($user){
            if(Hash::check($password, $user->password)){
                //$token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login exitoso',
                    'data' => $user,
                    //'token' => $token
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password incorrecto'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }

    }
}

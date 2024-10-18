<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //Login y que me devuelva un token 
    function login(Request $request){
        $email=$request->email;
        $password=$request->password;

        //verificar la existencia de usuario
        $user = User::where('email', $email)->first();
        if($user){ 
            //si existe verificamos el password con unhash 
            if(Hash::check($password, $user->password)){
                //El servidor retorna  un token en texto plano 
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login exitoso',
                    'data' => $user,
                    'token' => $token
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
            ],404);
        }

    }
}

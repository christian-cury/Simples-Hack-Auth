<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login(Request $request) {

        $response = [];

        if($request->has('username')  && $request->has('password')) {
            $username = $request->username;
            $password = $request->password;

            $user = User::where('username', '=', $username)->first();

            if(!is_null($user)) {
                $hashedPassword = $user->password;

                if(\Hash::check($password, $hashedPassword)) {
                    $response = [
                        'code' => 300,
                        'message' => 'Usuario valido'
                    ];
                }
                else {
                    $response = [
                        'code' => 301,
                        'message' => 'Senha incorreta'
                    ];
                }
            }
            else {
                $response = [
                    'code' => 302,
                    'message' => 'Usuario nao existe'
                ];
            }
        }
        else {
            $response = [
                'code' => 303,
                'message' => 'Variaveis faltando'
            ];
        }

        return response()->json($response);
    }


    public function register(Request $request) {
        $response = [];

        if($request->has('username')  && $request->has('password') && $request->has('password_confirmation')) {
            $username = $request->username;
            $password = $request->password;
            $cPassword = $request->password_confirmation;

            $userExists = User::where('username', '=', $username)->count();

            if(!($userExists > 0)) {
                if($password === $cPassword) {
                    $user = new User;
                    $user->username = $username;
                    $user->password = \Hash::make($password);
                    $user->save();

                    $response = [
                        'code' => 400,
                        'message' => 'Usuario ' . $username . ' criado com sucesso!'
                    ];
                }
                else {
                    $response = [
                        'code' => 402,
                        'message' => 'Senhas nao coincidem'
                    ];
                }
            }
            else {
                $response = [
                    'code' => 403,
                    'message' => 'Ja existe um usuario com este nome'
                ];
            }
        }
        else {
            $response = [
                'code' => 404,
                'message' => 'Variaveis faltando'
            ];
        }

        return response()->json($response);
    }
}

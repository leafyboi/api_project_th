<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'unique:users',
            'name' => '',
            'surname' => '',
            'password' => 'confirmed'
        ]);


        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->token;

        $errors = array();

        return response([
            'has_errors' => false,
            'errors' => $errors,
            'message' => 'Регистрация прошла успешно. Вы были перенаправлены на страницу авторизации.']);
    }


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Не удаётся войти. Неверный логин или пароль.']);
        }

        $token = auth()->user()->createToken('authToken')->accessToken; // accessTok

        $errors = array();

        return response([
            'has_errors' => false,
            'errors' => $errors,
            'user' => auth()->user(),
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->logout();

        $errors = array();

        return response()->json([
            'has_errors'=>false,
            'errors'=>$errors,
            'message' => 'Вы успешно вышли из системы.']);
    }

}

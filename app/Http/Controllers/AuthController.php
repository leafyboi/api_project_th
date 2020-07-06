<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'unique:users',
            'name' => '',
            'surname' => ''
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        if($user) {
            return response()->json([
            'message' => 'Регистрация прошла успешно. Вы были перенаправлены на страницу авторизации.'],201);}
    }


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => '',
            'password' => ''
        ]);
        if (!auth()->attempt($loginData)) {
            return response([
                'message' => 'Не удаётся войти. Неверный логин или пароль.']);
        }

        $user = Auth::user();
        $token = $user->generateToken(); // accessTok
        $user->api_token = $token;
        Auth::user()->save();

        return response([
            'user' => auth()->user(),
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Вы успешно вышли из системы.']);
    }

    public function refresh()
    {

    }
}

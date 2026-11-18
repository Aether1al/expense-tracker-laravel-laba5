<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function reg()
    {
        return view('reg');
    }

    public function auth_user(Request $request)
    {
        $validate = $request->validate([
            'email' => ['email', 'required'],
            'password' => [ 'required', 'min:6'],
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
            'password' => 'Неверный email или пароль.',
        ]);
    }

    public function add_user(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['password', 'required', 'min:6'],
        ]);

        $add_user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);
        Auth::login($add_user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}

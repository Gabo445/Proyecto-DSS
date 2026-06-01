<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Muestra formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesa el registro de un nuevo usuario
    public function register(Request $request)
    {
        // Validar datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'edad' => 'required|integer|min:15|max:100',
            'peso_objetivo' => 'required|numeric|min:20|max:300',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'edad' => $request->edad,
            'peso_objetivo' => $request->peso_objetivo,
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Bienvenido al Sistema de Fitness');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Bienvenido de vuelta');
        }

        return back()->withErrors(['error' => 'Credenciales incorrectas']);
    }

    // Cierra sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
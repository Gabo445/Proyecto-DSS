<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Muestra el perfil del usuario
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    // Muestra formulario para editar perfil
    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    // Actualiza el perfil del usuario
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'edad' => 'required|integer|min:15|max:100',
            'peso_objetivo' => 'required|numeric|min:20|max:300',
        ]);

        $user->update([
            'name' => $request->name,
            'edad' => $request->edad,
            'peso_objetivo' => $request->peso_objetivo,
        ]);

        return redirect()->route('perfil')->with('success', 'Perfil actualizado');
    }
}
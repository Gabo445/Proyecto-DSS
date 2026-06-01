<?php

namespace App\Http\Controllers;

use App\Models\RegistroPeso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroPesoController extends Controller
{
    // Lista todos los registros de peso del usuario
    public function index()
    {
        $registros = RegistroPeso::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('registro-pesos.index', compact('registros'));
    }

    // Muestra formulario para registrar peso
    public function create()
    {
        return view('registro-pesos.create');
    }

    // Guarda un nuevo registro de peso
    public function store(Request $request)
    {
        $request->validate([
            'peso' => 'required|numeric|min:20|max:300',
            'fecha_registro' => 'required|date',
        ]);

        RegistroPeso::create([
            'user_id' => Auth::id(),
            'peso' => $request->peso,
            'fecha_registro' => $request->fecha_registro,
        ]);

        return redirect()->route('registro-pesos.index')->with('success', 'Peso registrado');
    }

    // Muestra detalle de un registro
    public function show(RegistroPeso $registroPeso)
    {
        // Verificar que el registro pertenezca al usuario
        if ($registroPeso->user_id != Auth::id()) {
            abort(403);
        }
        return view('registro-pesos.show', compact('registroPeso'));
    }

    // Muestra formulario para editar registro
    public function edit(RegistroPeso $registroPeso)
    {
        if ($registroPeso->user_id != Auth::id()) {
            abort(403);
        }
        return view('registro-pesos.edit', compact('registroPeso'));
    }

    // Actualiza un registro de peso
    public function update(Request $request, RegistroPeso $registroPeso)
    {
        if ($registroPeso->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'peso' => 'required|numeric|min:20|max:300',
            'fecha_registro' => 'required|date',
        ]);

        $registroPeso->update($request->all());

        return redirect()->route('registro-pesos.index')->with('success', 'Peso actualizado');
    }

    // Elimina un registro de peso
    public function destroy(RegistroPeso $registroPeso)
    {
        if ($registroPeso->user_id != Auth::id()) {
            abort(403);
        }

        $registroPeso->delete();
        return redirect()->route('registro-pesos.index')->with('success', 'Registro eliminado');
    }
}
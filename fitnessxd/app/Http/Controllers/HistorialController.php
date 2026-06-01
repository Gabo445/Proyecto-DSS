<?php

namespace App\Http\Controllers;

use App\Models\HistorialEntrenamiento;
use App\Models\Rutina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    // Lista el historial de entrenamientos del usuario
    public function index()
    {
        $historial = HistorialEntrenamiento::where('user_id', Auth::id())
            ->with('rutina')
            ->latest()
            ->paginate(15);
        return view('historial.index', compact('historial'));
    }

    // Muestra formulario para registrar entrenamiento completado
    public function create()
    {
        $rutinas = Rutina::where('user_id', Auth::id())->get();
        return view('historial.create', compact('rutinas'));
    }

    // Guarda un entrenamiento completado
    public function store(Request $request)
    {
        $request->validate([
            'rutina_id' => 'required|exists:rutinas,id',
            'fecha_entrenamiento' => 'required|date',
            'notas' => 'nullable|string',
        ]);

        // Verificar que la rutina pertenezca al usuario
        $rutina = Rutina::findOrFail($request->rutina_id);
        if ($rutina->user_id != Auth::id()) {
            abort(403);
        }

        HistorialEntrenamiento::create([
            'user_id' => Auth::id(),
            'rutina_id' => $request->rutina_id,
            'fecha_entrenamiento' => $request->fecha_entrenamiento,
            'notas' => $request->notas,
        ]);

        return redirect()->route('historial.index')->with('success', 'Entrenamiento registrado');
    }

    // Muestra detalle de un entrenamiento del historial
    public function show(HistorialEntrenamiento $historial)
    {
        if ($historial->user_id != Auth::id()) {
            abort(403);
        }
        return view('historial.show', compact('historial'));
    }

    // Elimina un registro del historial
    public function destroy(HistorialEntrenamiento $historial)
    {
        if ($historial->user_id != Auth::id()) {
            abort(403);
        }

        $historial->delete();
        return redirect()->route('historial.index')->with('success', 'Registro eliminado');
    }
}
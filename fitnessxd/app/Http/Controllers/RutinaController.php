<?php

namespace App\Http\Controllers;

use App\Models\Rutina;
use App\Models\EjercicioRutina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RutinaController extends Controller
{
    // Lista todas las rutinas del usuario
    public function index()
    {
        $rutinas = Rutina::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('rutinas.index', compact('rutinas'));
    }

    // Muestra formulario para crear rutina
    public function create()
    {
        // Obtener ejercicios desde API externa (ejemplo)
        $ejercicios = $this->obtenerEjerciciosApi();
        return view('rutinas.create', compact('ejercicios'));
    }

    // Guarda una nueva rutina
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'ejercicios' => 'required|array',
            'ejercicios.*.ejercicio_api_id' => 'required',
            'ejercicios.*.series' => 'required|integer|min:1',
            'ejercicios.*.repeticiones' => 'required|integer|min:1',
            'ejercicios.*.peso' => 'nullable|numeric',
        ]);

        // Crear la rutina
        $rutina = Rutina::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_creacion' => now(),
        ]);

        // Guardar los ejercicios asociados
        foreach ($request->ejercicios as $ejercicio) {
            EjercicioRutina::create([
                'rutina_id' => $rutina->id,
                'ejercicio_api_id' => $ejercicio['ejercicio_api_id'],
                'series' => $ejercicio['series'],
                'repeticiones' => $ejercicio['repeticiones'],
                'peso' => $ejercicio['peso'] ?? null,
            ]);
        }

        return redirect()->route('rutinas.index')->with('success', 'Rutina creada');
    }

    // Muestra detalle de una rutina
    public function show(Rutina $rutina)
    {
        if ($rutina->user_id != Auth::id()) {
            abort(403);
        }

        $ejercicios = $rutina->ejercicios()->get();
        return view('rutinas.show', compact('rutina', 'ejercicios'));
    }

    // Muestra formulario para editar rutina
    public function edit(Rutina $rutina)
    {
        if ($rutina->user_id != Auth::id()) {
            abort(403);
        }

        $ejercicios = $rutina->ejercicios()->get();
        $ejerciciosApi = $this->obtenerEjerciciosApi();

        return view('rutinas.edit', compact('rutina', 'ejercicios', 'ejerciciosApi'));
    }

    // Actualiza una rutina
    public function update(Request $request, Rutina $rutina)
    {
        if ($rutina->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $rutina->update($request->only('nombre', 'descripcion'));

        return redirect()->route('rutinas.index')->with('success', 'Rutina actualizada');
    }

    // Elimina una rutina
    public function destroy(Rutina $rutina)
    {
        if ($rutina->user_id != Auth::id()) {
            abort(403);
        }

        $rutina->delete();
        return redirect()->route('rutinas.index')->with('success', 'Rutina eliminada');
    }

    // Obtiene ejercicios desde API externa (WGER - API gratuita de ejercicios)
    private function obtenerEjerciciosApi()
    {
        try {
            $response = Http::get('https://wger.de/api/v2/exercise/');
            if ($response->successful()) {
                return $response->json()['results'] ?? [];
            }
        } catch (\Exception $e) {
            // Si falla la API, devolver datos de ejemplo
            return $this->obtenerEjerciciosEjemplo();
        }
        return [];
    }

    // Ejercicios de ejemplo en caso que la API no funcione
    private function obtenerEjerciciosEjemplo()
    {
        return [
            ['id' => 'push-up', 'name' => 'Lagartijas (Push-up)'],
            ['id' => 'squat', 'name' => 'Sentadillas (Squat)'],
            ['id' => 'pull-up', 'name' => 'Dominadas (Pull-up)'],
            ['id' => 'jumping-jacks', 'name' => 'Saltos de tijera (Jumping Jacks)'],
            ['id' => 'lunges', 'name' => 'Zancadas (Lunges)'],
            ['id' => 'plank', 'name' => 'Plancha (Plank)'],
            ['id' => 'burpees', 'name' => 'Burpees'],
            ['id' => 'sit-up', 'name' => 'Abdominales (Sit-up)'],
        ];
    }
}
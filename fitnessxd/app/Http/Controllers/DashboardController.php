<?php

namespace App\Http\Controllers;

use App\Models\RegistroPeso;
use App\Models\Rutina;
use App\Models\HistorialEntrenamiento;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Estadísticas
        $totalRutinas = Rutina::where('user_id', $user->id)->count();
        $totalEntrenamientos = HistorialEntrenamiento::where('user_id', $user->id)->count();
        $ultimoPeso = RegistroPeso::where('user_id', $user->id)->latest()->first();
        $progresoPeso = $this->calcularProgresoPeso($user);
        $imc = $this->calcularIMC($user);
        $mmc = $this->calcularMMC($user);

        return view('dashboard', compact(
            'user',
            'totalRutinas',
            'totalEntrenamientos',
            'ultimoPeso',
            'progresoPeso',
            'imc',
            'mmc'
        ));
    }

    // Calcular Índice de Masa Corporal (IMC)
    private function calcularIMC($user)
    {
        $ultimoPeso = RegistroPeso::where('user_id', $user->id)->latest()->first();
        if (!$ultimoPeso) {
            return null;
        }

        // Fórmula IMC = peso / (altura^2)
        // Altura promedio estimada 1.70m (puedes agregar campo altura al usuario)
        $altura = 1.70;
        $imc = $ultimoPeso->peso / ($altura * $altura);
        return round($imc, 1);
    }

    // Calcular Masa Muscular Corporal (estimación)
    private function calcularMMC($user)
    {
        // Fórmula simplificada para estimar masa muscular
        // Puedes mejorarla con más datos del usuario
        $ultimoPeso = RegistroPeso::where('user_id', $user->id)->latest()->first();
        if (!$ultimoPeso) {
            return null;
        }

        // Estimación: 70-80% del peso para un adulto promedio
        $mmc = $ultimoPeso->peso * 0.75;
        return round($mmc, 1);
    }

    // Calcular progreso hacia el peso objetivo
    private function calcularProgresoPeso($user)
    {
        $ultimoPeso = RegistroPeso::where('user_id', $user->id)->latest()->first();
        if (!$ultimoPeso || !$user->peso_objetivo) {
            return null;
        }

        $diferencia = $user->peso_objetivo - $ultimoPeso->peso;
        $progreso = 100 - (($diferencia / $user->peso_objetivo) * 100);
        return round($progreso, 1);
    }
}
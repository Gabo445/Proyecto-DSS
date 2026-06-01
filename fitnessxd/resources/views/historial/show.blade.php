@extends('layouts.app')

@section('title', 'Detalle del Entrenamiento')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Detalle del Entrenamiento</h2>
        <p class="text-muted mb-0">
            <i class="bi bi-calendar3"></i>
            {{ $historial->fecha_entrenamiento->format('d/m/Y') }}
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('historial.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <form action="{{ route('historial.destroy', $historial) }}"
              method="POST"
              onsubmit="return confirm('¿Eliminar este registro?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger">
                <i class="bi bi-trash"></i> Eliminar
            </button>
        </form>
    </div>
</div>

<div class="row g-3">

    {{-- Info principal --}}
    <div class="col-12 col-lg-5">
        <div class="card h-100">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-info-circle text-success"></i> Información
            </div>
            <div class="card-body">

                <div class="bg-light rounded-3 p-3 mb-3">
                    <p class="text-muted small mb-1">
                        <i class="bi bi-journal-text"></i> Rutina
                    </p>
                    <p class="fw-semibold mb-0">
                        {{ $historial->rutina->nombre ?? 'Rutina eliminada' }}
                    </p>
                </div>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <p class="text-muted small mb-1">
                        <i class="bi bi-calendar3"></i> Fecha
                    </p>
                    <p class="fw-semibold mb-0">
                        {{ $historial->fecha_entrenamiento->format('d \d\e F \d\e Y') }}
                    </p>
                </div>

                <div class="bg-light rounded-3 p-3">
                    <p class="text-muted small mb-1">
                        <i class="bi bi-chat-text"></i> Notas
                    </p>
                    <p class="mb-0">
                        {{ $historial->notas ?? 'Sin notas registradas' }}
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Ejercicios de la rutina --}}
    <div class="col-12 col-lg-7">
        <div class="card h-100">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-list-check text-primary"></i> Ejercicios realizados
            </div>
            <div class="card-body p-0">
                @if($historial->rutina && $historial->rutina->ejercicios->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ejercicio</th>
                                    <th class="text-center">Series</th>
                                    <th class="text-center">Reps</th>
                                    <th class="text-center">Peso</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historial->rutina->ejercicios as $ejercicio)
                                <tr>
                                    <td class="fw-semibold">{{ $ejercicio->ejercicio_api_id }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $ejercicio->series }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">{{ $ejercicio->repeticiones }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($ejercicio->peso)
                                            <span class="badge bg-warning text-dark">{{ $ejercicio->peso }} kg</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-list-ul fs-1 d-block mb-2"></i>
                        No hay ejercicios disponibles
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', $rutina->nombre)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">{{ $rutina->nombre }}</h2>
        <p class="text-muted mb-0">
            <i class="bi bi-calendar3"></i>
            Creada el {{ $rutina->fecha_creacion->format('d/m/Y') }}
        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('rutinas.edit', $rutina) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('rutinas.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

{{-- Descripción --}}
@if($rutina->descripcion)
<div class="card mb-4">
    <div class="card-body">
        <h6 class="fw-semibold text-muted mb-2">
            <i class="bi bi-text-paragraph"></i> Descripción
        </h6>
        <p class="mb-0">{{ $rutina->descripcion }}</p>
    </div>
</div>
@endif

{{-- Ejercicios --}}
<div class="card">
    <div class="card-header fw-semibold bg-white">
        <i class="bi bi-list-check text-primary"></i> Ejercicios de esta rutina
    </div>
    <div class="card-body p-0">
        @if($ejercicios->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ejercicio</th>
                            <th class="text-center">Series</th>
                            <th class="text-center">Repeticiones</th>
                            <th class="text-center">Peso (kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ejercicios as $i => $ejercicio)
                        <tr>
                            <td class="text-muted">{{ $i + 1 }}</td>
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
                                    <span class="text-muted small">—</span>
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
                Esta rutina no tiene ejercicios registrados
            </div>
        @endif
    </div>
</div>

@endsection
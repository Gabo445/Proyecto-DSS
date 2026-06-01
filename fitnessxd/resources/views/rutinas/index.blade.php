@extends('layouts.app')

@section('title', 'Mis Rutinas')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Mis Rutinas</h2>
        <p class="text-muted mb-0">Administra tus rutinas de entrenamiento</p>
    </div>
    <a href="{{ route('rutinas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nueva rutina
    </a>
</div>

@if($rutinas->count() > 0)
    <div class="row g-3">
        @foreach($rutinas as $rutina)
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold mb-0">{{ $rutina->nombre }}</h5>
                        <span class="badge bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-calendar3"></i>
                            {{ $rutina->fecha_creacion->format('d/m/Y') }}
                        </span>
                    </div>
                    <p class="text-muted small mb-3">
                        {{ $rutina->descripcion ?? 'Sin descripción' }}
                    </p>
                </div>
                <div class="card-footer bg-white border-top d-flex gap-2">
                    <a href="{{ route('rutinas.show', $rutina) }}"
                       class="btn btn-sm btn-outline-primary flex-grow-1">
                        <i class="bi bi-eye"></i> Ver
                    </a>
                    <a href="{{ route('rutinas.edit', $rutina) }}"
                       class="btn btn-sm btn-outline-warning flex-grow-1">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('rutinas.destroy', $rutina) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar esta rutina?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $rutinas->links('pagination::bootstrap-5') }}
    </div>

@else
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
            <h5>Aún no tienes rutinas</h5>
            <p>Crea tu primera rutina de entrenamiento</p>
            <a href="{{ route('rutinas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Crear rutina
            </a>
        </div>
    </div>
@endif

@endsection
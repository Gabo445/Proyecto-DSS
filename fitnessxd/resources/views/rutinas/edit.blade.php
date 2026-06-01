@extends('layouts.app')

@section('title', 'Editar Rutina')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Editar Rutina</h2>
        <p class="text-muted mb-0">Modifica los datos de tu rutina</p>
    </div>
    <a href="{{ route('rutinas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-header fw-semibold bg-white">
        <i class="bi bi-pencil text-warning"></i> Modificar rutina
    </div>
    <div class="card-body p-4">
        <form action="{{ route('rutinas.update', $rutina) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label fw-semibold">
                    <i class="bi bi-fonts"></i> Nombre de la rutina
                </label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $rutina->nombre) }}"
                    required
                >
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="mb-4">
                <label for="descripcion" class="form-label fw-semibold">
                    <i class="bi bi-text-paragraph"></i> Descripción
                </label>
                <textarea
                    name="descripcion"
                    id="descripcion"
                    rows="3"
                    class="form-control @error('descripcion') is-invalid @enderror"
                >{{ old('descripcion', $rutina->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning flex-grow-1">
                    <i class="bi bi-check-circle"></i> Actualizar rutina
                </button>
                <a href="{{ route('rutinas.index') }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
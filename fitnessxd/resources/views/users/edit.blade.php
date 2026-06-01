@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Editar Perfil</h2>
        <p class="text-muted mb-0">Actualiza tu información personal</p>
    </div>
    <a href="{{ route('perfil') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-pencil text-primary"></i> Modificar datos
            </div>
            <div class="card-body p-4">
                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            <i class="bi bi-person"></i> Nombre completo
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Edad --}}
                    <div class="mb-3">
                        <label for="edad" class="form-label fw-semibold">
                            <i class="bi bi-calendar"></i> Edad
                        </label>
                        <input
                            type="number"
                            name="edad"
                            id="edad"
                            class="form-control @error('edad') is-invalid @enderror"
                            value="{{ old('edad', $user->edad) }}"
                            min="15"
                            max="100"
                            required
                        >
                        @error('edad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Peso objetivo --}}
                    <div class="mb-4">
                        <label for="peso_objetivo" class="form-label fw-semibold">
                            <i class="bi bi-bullseye"></i> Peso objetivo (kg)
                        </label>
                        <input
                            type="number"
                            name="peso_objetivo"
                            id="peso_objetivo"
                            class="form-control @error('peso_objetivo') is-invalid @enderror"
                            value="{{ old('peso_objetivo', $user->peso_objetivo) }}"
                            min="20"
                            max="300"
                            step="0.1"
                            required
                        >
                        @error('peso_objetivo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-circle"></i> Guardar cambios
                        </button>
                        <a href="{{ route('perfil') }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
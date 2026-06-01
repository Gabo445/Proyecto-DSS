@extends('layouts.app')

@section('title', 'Registrar Peso')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Registrar Peso</h2>
        <p class="text-muted mb-0">Agrega un nuevo registro de tu peso</p>
    </div>
    <a href="{{ route('registro-pesos.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-5">
        <div class="card">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-graph-up text-warning"></i> Nuevo registro
            </div>
            <div class="card-body p-4">
                <form action="{{ route('registro-pesos.store') }}" method="POST">
                    @csrf

                    {{-- Peso --}}
                    <div class="mb-3">
                        <label for="peso" class="form-label fw-semibold">
                            <i class="bi bi-speedometer"></i> Peso actual (kg)
                        </label>
                        <div class="input-group">
                            <input
                                type="number"
                                name="peso"
                                id="peso"
                                class="form-control form-control-lg @error('peso') is-invalid @enderror"
                                placeholder="Ej: 75.5"
                                value="{{ old('peso') }}"
                                min="20"
                                max="300"
                                step="0.1"
                                required
                                autofocus
                            >
                            <span class="input-group-text fw-semibold">kg</span>
                            @error('peso')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Fecha --}}
                    <div class="mb-4">
                        <label for="fecha_registro" class="form-label fw-semibold">
                            <i class="bi bi-calendar3"></i> Fecha del registro
                        </label>
                        <input
                            type="date"
                            name="fecha_registro"
                            id="fecha_registro"
                            class="form-control form-control-lg @error('fecha_registro') is-invalid @enderror"
                            value="{{ old('fecha_registro', date('Y-m-d')) }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >
                        @error('fecha_registro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-circle"></i> Guardar registro
                        </button>
                        <a href="{{ route('registro-pesos.index') }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
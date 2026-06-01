@extends('layouts.app')

@section('title', 'Detalle del Registro')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Detalle del Registro</h2>
        <p class="text-muted mb-0">Información de tu registro de peso</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('registro-pesos.edit', $registroPeso) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('registro-pesos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-5">
        <div class="card">
            <div class="card-body p-4">

                {{-- Peso destacado --}}
                <div class="text-center py-4 mb-3 bg-warning bg-opacity-10 rounded-3">
                    <p class="text-muted small mb-1">Peso registrado</p>
                    <h1 class="fw-bold text-warning mb-0">
                        {{ $registroPeso->peso }}
                        <span class="fs-4">kg</span>
                    </h1>
                </div>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <p class="text-muted small mb-1">
                        <i class="bi bi-calendar3"></i> Fecha del registro
                    </p>
                    <p class="fw-semibold mb-0">
                        {{ $registroPeso->fecha_registro->format('d \d\e F \d\e Y') }}
                    </p>
                </div>

                <div class="bg-light rounded-3 p-3 mb-4">
                    <p class="text-muted small mb-1">
                        <i class="bi bi-clock"></i> Registrado el
                    </p>
                    <p class="fw-semibold mb-0">
                        {{ $registroPeso->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                {{-- Eliminar --}}
                <form action="{{ route('registro-pesos.destroy', $registroPeso) }}"
                      method="POST"
                      onsubmit="return confirm('¿Eliminar este registro?')">
                    @csrf
                    @method('DELETE')
                    <div class="d-grid">
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-trash"></i> Eliminar registro
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
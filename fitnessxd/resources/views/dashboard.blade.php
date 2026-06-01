@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">¡Hola, {{ $user->name }}! 👋</h2>
        <p class="text-muted mb-0">Aquí tienes un resumen de tu progreso</p>
    </div>
    <a href="{{ route('registro-pesos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Registrar peso
    </a>
</div>

{{-- Tarjetas de estadísticas --}}
<div class="row g-3 mb-4">

    {{-- Rutinas --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-primary border-4">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-journal-text text-primary fs-3"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">Rutinas creadas</p>
                    <h3 class="fw-bold mb-0">{{ $totalRutinas }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Entrenamientos --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-success border-4">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-clock-history text-success fs-3"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">Entrenamientos</p>
                    <h3 class="fw-bold mb-0">{{ $totalEntrenamientos }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Peso actual --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-warning border-4">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-graph-up text-warning fs-3"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">Peso actual</p>
                    <h3 class="fw-bold mb-0">
                        @if($ultimoPeso)
                            {{ $ultimoPeso->peso }} kg
                        @else
                            <span class="text-muted fs-6">Sin registro</span>
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- IMC --}}
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-info border-4">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-info bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-heart-pulse text-info fs-3"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">IMC estimado</p>
                    <h3 class="fw-bold mb-0">
                        @if($imc)
                            {{ $imc }}
                        @else
                            <span class="text-muted fs-6">Sin datos</span>
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Fila inferior --}}
<div class="row g-3">

    {{-- Progreso hacia peso objetivo --}}
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-bullseye text-danger"></i> Progreso hacia tu peso objetivo
            </div>
            <div class="card-body">
                @if($ultimoPeso && $user->peso_objetivo)
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Peso actual: <strong>{{ $ultimoPeso->peso }} kg</strong></span>
                        <span class="text-muted small">Objetivo: <strong>{{ $user->peso_objetivo }} kg</strong></span>
                    </div>
                    @php
                        $progreso = min(max($progresoPeso, 0), 100);
                        $colorBarra = $progreso >= 100 ? 'success' : ($progreso >= 60 ? 'warning' : 'danger');
                    @endphp
                    <div class="progress" style="height: 20px;">
                        <div
                            class="progress-bar bg-{{ $colorBarra }} progress-bar-striped progress-bar-animated"
                            role="progressbar"
                            style="width: {{ $progreso }}%"
                        >
                            {{ $progreso }}%
                        </div>
                    </div>
                    <p class="text-muted small mt-2 mb-0">
                        @if($progresoPeso >= 100)
                            🎉 ¡Alcanzaste tu objetivo!
                        @else
                            Te faltan <strong>{{ abs(round($user->peso_objetivo - $ultimoPeso->peso, 1)) }} kg</strong> para tu meta.
                        @endif
                    </p>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-graph-up fs-1 d-block mb-2"></i>
                        Registra tu peso para ver tu progreso
                        <div class="mt-3">
                            <a href="{{ route('registro-pesos.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-plus"></i> Registrar ahora
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Masa muscular + accesos rápidos --}}
    <div class="col-12 col-lg-6">
        <div class="card h-100">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-lightning-charge text-warning"></i> Accesos rápidos
            </div>
            <div class="card-body">

                @if($mmc)
                    <div class="alert alert-secondary py-2 mb-3">
                        <i class="bi bi-person-fill"></i>
                        Masa muscular estimada: <strong>{{ $mmc }} kg</strong>
                    </div>
                @endif

                <div class="d-grid gap-2">
                    <a href="{{ route('rutinas.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle"></i> Nueva rutina
                    </a>
                    <a href="{{ route('historial.create') }}" class="btn btn-outline-success">
                        <i class="bi bi-check2-circle"></i> Registrar entrenamiento
                    </a>
                    <a href="{{ route('registro-pesos.create') }}" class="btn btn-outline-warning">
                        <i class="bi bi-graph-up-arrow"></i> Registrar peso
                    </a>
                    <a href="{{ route('perfil') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-person-circle"></i> Ver mi perfil
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
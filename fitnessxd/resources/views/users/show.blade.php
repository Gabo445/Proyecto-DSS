@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Mi Perfil</h2>
        <p class="text-muted mb-0">Tu información personal</p>
    </div>
    <a href="{{ route('perfil.edit') }}" class="btn btn-primary">
        <i class="bi bi-pencil"></i> Editar perfil
    </a>
</div>

<div class="row g-3">

    {{-- Tarjeta principal --}}
    <div class="col-12 col-lg-4">
        <div class="card text-center h-100">
            <div class="card-body py-5">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                     style="width: 90px; height: 90px;">
                    <i class="bi bi-person-fill text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                <span class="badge bg-primary px-3 py-2">
                    <i class="bi bi-lightning-charge-fill"></i> Usuario activo
                </span>
            </div>
        </div>
    </div>

    {{-- Datos del usuario --}}
    <div class="col-12 col-lg-8">
        <div class="card h-100">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-info-circle text-primary"></i> Datos personales
            </div>
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-12 col-sm-6">
                        <div class="bg-light rounded-3 p-3">
                            <p class="text-muted small mb-1">
                                <i class="bi bi-person"></i> Nombre
                            </p>
                            <p class="fw-semibold mb-0">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="bg-light rounded-3 p-3">
                            <p class="text-muted small mb-1">
                                <i class="bi bi-envelope"></i> Correo
                            </p>
                            <p class="fw-semibold mb-0">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="bg-light rounded-3 p-3">
                            <p class="text-muted small mb-1">
                                <i class="bi bi-calendar"></i> Edad
                            </p>
                            <p class="fw-semibold mb-0">{{ $user->edad }} años</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="bg-light rounded-3 p-3">
                            <p class="text-muted small mb-1">
                                <i class="bi bi-bullseye"></i> Peso objetivo
                            </p>
                            <p class="fw-semibold mb-0">{{ $user->peso_objetivo }} kg</p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="bg-light rounded-3 p-3">
                            <p class="text-muted small mb-1">
                                <i class="bi bi-clock"></i> Miembro desde
                            </p>
                            <p class="fw-semibold mb-0">
                                {{ $user->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
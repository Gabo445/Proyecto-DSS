@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 100%; max-width: 480px;">
        <div class="card-body p-5">

            {{-- Logo / título --}}
            <div class="text-center mb-4">
                <span style="font-size: 2.5rem;">⚡</span>
                <h2 class="fw-bold mt-2">FitnessApp</h2>
                <p class="text-muted">Crea tu cuenta gratuita</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf

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
                        placeholder="Tu nombre"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope"></i> Correo electrónico
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="tucorreo@ejemplo.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-lock"></i> Contraseña
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Mínimo 6 caracteres"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        <i class="bi bi-lock-fill"></i> Confirmar contraseña
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Repite tu contraseña"
                        required
                    >
                </div>

                {{-- Fila: Edad y Peso objetivo --}}
                <div class="row mb-4">
                    <div class="col-6">
                        <label for="edad" class="form-label fw-semibold">
                            <i class="bi bi-calendar"></i> Edad
                        </label>
                        <input
                            type="number"
                            name="edad"
                            id="edad"
                            class="form-control @error('edad') is-invalid @enderror"
                            placeholder="Ej: 25"
                            value="{{ old('edad') }}"
                            min="15"
                            max="100"
                            required
                        >
                        @error('edad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="peso_objetivo" class="form-label fw-semibold">
                            <i class="bi bi-bullseye"></i> Peso objetivo (kg)
                        </label>
                        <input
                            type="number"
                            name="peso_objetivo"
                            id="peso_objetivo"
                            class="form-control @error('peso_objetivo') is-invalid @enderror"
                            placeholder="Ej: 70"
                            value="{{ old('peso_objetivo') }}"
                            min="20"
                            max="300"
                            step="0.1"
                            required
                        >
                        @error('peso_objetivo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Botón --}}
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-person-check"></i> Crear cuenta
                    </button>
                </div>

                {{-- Link a login --}}
                <p class="text-center text-muted mb-0">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-primary fw-semibold">Inicia sesión</a>
                </p>

            </form>
        </div>
    </div>
</div>
@endsection
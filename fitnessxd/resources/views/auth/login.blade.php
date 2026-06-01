@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 100%; max-width: 420px;">
        <div class="card-body p-5">

            {{-- Logo / título --}}
            <div class="text-center mb-4">
                <span style="font-size: 2.5rem;">⚡</span>
                <h2 class="fw-bold mt-2">FitnessApp</h2>
                <p class="text-muted">Inicia sesión en tu cuenta</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope"></i> Correo electrónico
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="tucorreo@ejemplo.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-lock"></i> Contraseña
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Error general --}}
                @error('error')
                    <div class="alert alert-danger py-2">
                        <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                    </div>
                @enderror

                {{-- Botón --}}
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                    </button>
                </div>

                {{-- Link a registro --}}
                <p class="text-center text-muted mb-0">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="text-primary fw-semibold">Regístrate aquí</a>
                </p>
            </form>

        </div>
    </div>
</div>
@endsection
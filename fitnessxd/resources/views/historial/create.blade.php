@extends('layouts.app')

@section('title', 'Registrar Entrenamiento')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Registrar Entrenamiento</h2>
        <p class="text-muted mb-0">Marca una rutina como completada</p>
    </div>
    <a href="{{ route('historial.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header fw-semibold bg-white">
                <i class="bi bi-check2-circle text-success"></i> Datos del entrenamiento
            </div>
            <div class="card-body p-4">
                <form action="{{ route('historial.store') }}" method="POST">
                    @csrf

                    {{-- Rutina --}}
                    <div class="mb-3">
                        <label for="rutina_id" class="form-label fw-semibold">
                            <i class="bi bi-journal-text"></i> Rutina realizada
                        </label>
                        <select
                            name="rutina_id"
                            id="rutina_id"
                            class="form-select @error('rutina_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Selecciona una rutina...</option>
                            @foreach($rutinas as $rutina)
                                <option value="{{ $rutina->id }}"
                                    {{ old('rutina_id') == $rutina->id ? 'selected' : '' }}>
                                    {{ $rutina->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('rutina_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($rutinas->isEmpty())
                            <div class="form-text text-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                No tienes rutinas creadas.
                                <a href="{{ route('rutinas.create') }}">Crea una aquí</a>
                            </div>
                        @endif
                    </div>

                    {{-- Fecha --}}
                    <div class="mb-3">
                        <label for="fecha_entrenamiento" class="form-label fw-semibold">
                            <i class="bi bi-calendar3"></i> Fecha del entrenamiento
                        </label>
                        <input
                            type="date"
                            name="fecha_entrenamiento"
                            id="fecha_entrenamiento"
                            class="form-control @error('fecha_entrenamiento') is-invalid @enderror"
                            value="{{ old('fecha_entrenamiento', date('Y-m-d')) }}"
                            max="{{ date('Y-m-d') }}"
                            required
                        >
                        @error('fecha_entrenamiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Notas --}}
                    <div class="mb-4">
                        <label for="notas" class="form-label fw-semibold">
                            <i class="bi bi-chat-text"></i> Notas
                            <span class="text-muted fw-normal">(opcional)</span>
                        </label>
                        <textarea
                            name="notas"
                            id="notas"
                            rows="3"
                            class="form-control @error('notas') is-invalid @enderror"
                            placeholder="¿Cómo te fue? Anota cualquier observación..."
                        >{{ old('notas') }}</textarea>
                        @error('notas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1">
                            <i class="bi bi-check-circle"></i> Registrar entrenamiento
                        </button>
                        <a href="{{ route('historial.index') }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
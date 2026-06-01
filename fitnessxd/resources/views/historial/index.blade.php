@extends('layouts.app')

@section('title', 'Historial de Entrenamientos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Historial de Entrenamientos</h2>
        <p class="text-muted mb-0">Registro de todos tus entrenamientos</p>
    </div>
    <a href="{{ route('historial.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Registrar entrenamiento
    </a>
</div>

@if($historial->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Rutina</th>
                            <th>Fecha</th>
                            <th>Notas</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historial as $registro)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-success bg-opacity-10 rounded-2 p-2">
                                        <i class="bi bi-journal-check text-success"></i>
                                    </div>
                                    <span class="fw-semibold">
                                        {{ $registro->rutina->nombre ?? 'Rutina eliminada' }}
                                    </span>
                                </div>
                            </td>
                            <td class="text-muted">
                                <i class="bi bi-calendar3"></i>
                                {{ $registro->fecha_entrenamiento->format('d/m/Y') }}
                            </td>
                            <td class="text-muted small">
                                {{ $registro->notas ? Str::limit($registro->notas, 40) : '—' }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('historial.show', $registro) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('historial.destroy', $registro) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Paginación --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $historial->links('pagination::bootstrap-5') }}
    </div>

@else
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="bi bi-clock-history fs-1 d-block mb-3"></i>
            <h5>Aún no tienes entrenamientos registrados</h5>
            <p>Registra tu primer entrenamiento completado</p>
            <a href="{{ route('historial.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Registrar ahora
            </a>
        </div>
    </div>
@endif

@endsection
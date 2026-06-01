@extends('layouts.app')

@section('title', 'Registro de Peso')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Registro de Peso</h2>
        <p class="text-muted mb-0">Seguimiento de tu progreso corporal</p>
    </div>
    <a href="{{ route('registro-pesos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Registrar peso
    </a>
</div>

@if($registros->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Peso</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-warning bg-opacity-10 rounded-2 p-2">
                                        <i class="bi bi-calendar3 text-warning"></i>
                                    </div>
                                    {{ $registro->fecha_registro->format('d/m/Y') }}
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold fs-5">{{ $registro->peso }}</span>
                                <span class="text-muted">kg</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('registro-pesos.show', $registro) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('registro-pesos.edit', $registro) }}"
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('registro-pesos.destroy', $registro) }}"
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
        {{ $registros->links('pagination::bootstrap-5') }}
    </div>

@else
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="bi bi-graph-up fs-1 d-block mb-3"></i>
            <h5>Aún no tienes registros de peso</h5>
            <p>Empieza a registrar tu peso para ver tu progreso</p>
            <a href="{{ route('registro-pesos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Registrar ahora
            </a>
        </div>
    </div>
@endif

@endsection
@extends('layouts.app')

@section('title', 'Nueva Rutina')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Nueva Rutina</h2>
        <p class="text-muted mb-0">Crea una rutina de entrenamiento</p>
    </div>
    <a href="{{ route('rutinas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-header fw-semibold bg-white">
        <i class="bi bi-journal-plus text-primary"></i> Datos de la rutina
    </div>
    <div class="card-body p-4">
        <form action="{{ route('rutinas.store') }}" method="POST">
            @csrf

            {{-- Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label fw-semibold">
                    <i class="bi bi-fonts"></i> Nombre de la rutina
                </label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    placeholder="Ej: Rutina de pecho y tríceps"
                    value="{{ old('nombre') }}"
                    required
                >
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="mb-4">
                <label for="descripcion" class="form-label fw-semibold">
                    <i class="bi bi-text-paragraph"></i> Descripción
                </label>
                <textarea
                    name="descripcion"
                    id="descripcion"
                    rows="3"
                    class="form-control @error('descripcion') is-invalid @enderror"
                    placeholder="Describe brevemente esta rutina..."
                >{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Ejercicios --}}
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="form-label fw-semibold mb-0">
                        <i class="bi bi-list-check"></i> Ejercicios
                    </label>
                    <button type="button" class="btn btn-sm btn-success" id="agregar-ejercicio">
                        <i class="bi bi-plus"></i> Agregar ejercicio
                    </button>
                </div>

                <div id="contenedor-ejercicios">
                    {{-- Ejercicio inicial --}}
                    <div class="ejercicio-item card bg-light border-0 mb-3 p-3">
                        <div class="row g-2 align-items-end">
                            <div class="col-12 col-md-4">
                                <label class="form-label small fw-semibold">Ejercicio</label>
                                <select name="ejercicios[0][ejercicio_api_id]" class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach($ejercicios as $ej)
                                        <option value="{{ $ej['id'] }}">
                                            {{ $ej['name'] ?? $ej['id'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small fw-semibold">Series</label>
                                <input type="number" name="ejercicios[0][series]"
                                       class="form-control" min="1" value="3" required>
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small fw-semibold">Reps</label>
                                <input type="number" name="ejercicios[0][repeticiones]"
                                       class="form-control" min="1" value="10" required>
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small fw-semibold">Peso (kg)</label>
                                <input type="number" name="ejercicios[0][peso]"
                                       class="form-control" min="0" step="0.5" placeholder="Opcional">
                            </div>
                            <div class="col-12 col-md-2 d-grid">
                                <button type="button"
                                        class="btn btn-outline-danger btn-eliminar"
                                        style="display:none!important">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">
                    <i class="bi bi-check-circle"></i> Guardar rutina
                </button>
                <a href="{{ route('rutinas.index') }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let index = 1;
    const ejercicios = @json($ejercicios);

    document.getElementById('agregar-ejercicio').addEventListener('click', function () {
        const contenedor = document.getElementById('contenedor-ejercicios');

        let opciones = '<option value="">Seleccionar...</option>';
        ejercicios.forEach(ej => {
            opciones += `<option value="${ej.id}">${ej.name ?? ej.id}</option>`;
        });

        const div = document.createElement('div');
        div.className = 'ejercicio-item card bg-light border-0 mb-3 p-3';
        div.innerHTML = `
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Ejercicio</label>
                    <select name="ejercicios[${index}][ejercicio_api_id]" class="form-select" required>
                        ${opciones}
                    </select>
                </div>
                <div class="col-4 col-md-2">
                    <label class="form-label small fw-semibold">Series</label>
                    <input type="number" name="ejercicios[${index}][series]"
                           class="form-control" min="1" value="3" required>
                </div>
                <div class="col-4 col-md-2">
                    <label class="form-label small fw-semibold">Reps</label>
                    <input type="number" name="ejercicios[${index}][repeticiones]"
                           class="form-control" min="1" value="10" required>
                </div>
                <div class="col-4 col-md-2">
                    <label class="form-label small fw-semibold">Peso (kg)</label>
                    <input type="number" name="ejercicios[${index}][peso]"
                           class="form-control" min="0" step="0.5" placeholder="Opcional">
                </div>
                <div class="col-12 col-md-2 d-grid">
                    <button type="button" class="btn btn-outline-danger btn-eliminar">
                        <i class="bi bi-trash"></i> Quitar
                    </button>
                </div>
            </div>`;
        contenedor.appendChild(div);
        index++;

        div.querySelector('.btn-eliminar').addEventListener('click', function () {
            div.remove();
        });
    });
</script>
@endpush
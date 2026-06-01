<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RutinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la rutina es obligatorio',
            'descripcion.required' => 'La descripción es obligatoria',
        ];
    }
}
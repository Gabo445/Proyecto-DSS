<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroPesoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'peso' => 'required|numeric|min:1|max:700',
            'fecha_registro' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'peso.required' => 'Debe ingresar un peso',
            'peso.numeric' => 'El peso debe ser numérico',
            'fecha_registro.required' => 'La fecha es obligatoria',
        ];
    }
}
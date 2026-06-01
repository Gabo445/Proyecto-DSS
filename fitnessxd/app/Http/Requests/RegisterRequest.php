<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',           
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'edad' => 'required|integer|min:12|max:100',
            'peso_objetivo' => 'required|numeric|min:20|max:300',  
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',  
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Ingrese un correo válido',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'Mínimo 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'peso_objetivo.required' => 'El peso objetivo es obligatorio',  
        ];
    }
}
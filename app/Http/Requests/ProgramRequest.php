<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|in:movie,series',
            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'cover_image' => 'nullable|string'
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser una cadena de texto.',
            'title.max' => 'El título no debe exceder los 255 caracteres.',
            'type.required' => 'El tipo es obligatorio.',
            'type.in' => 'El tipo debe ser "movie" o "series".',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'release_date.date' => 'La fecha de lanzamiento debe ser una fecha válida.',
            'cover_image.string' => 'La imagen de portada debe ser una cadena de texto.'
        ];
    }   

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Errores de validación',
            'errors' => $validator->errors(),
        ], 422));
    }
}

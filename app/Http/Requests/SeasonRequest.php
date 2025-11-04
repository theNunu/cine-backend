<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class SeasonRequest extends FormRequest
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
            //
            'program_id' => 'required|exists:programs,program_id',
            'season_number' => 'required|integer|min:1',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'description' => 'nullable|string'
        ];
    }

    public function messages():array {

        return [
            'program_id.required' => 'El campo program_id es obligatorio.',
            'program_id.exists' => 'El program_id especificado no existe.',
            'season_number.required' => 'El campo season_number es obligatorio.',
            'season_number.integer' => 'El campo season_number debe ser un número entero.',
            'season_number.min' => 'El campo season_number debe ser al menos 1.',
            'release_year.integer' => 'El campo release_year debe ser un número entero.',
            'release_year.min' => 'El campo release_year debe ser al menos 1900.',
            'release_year.max' => 'El campo release_year no puede ser mayor que el año actual.',
            'description.string' => 'El campo description debe ser una cadena de texto.'
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

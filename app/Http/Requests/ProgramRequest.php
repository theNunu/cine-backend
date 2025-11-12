<?php

namespace App\Http\Requests;

use App\Enums\ProgramType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
            // 'type' => 'required|in:movie,series',
            'type' => ['required', Rule::in(ProgramType::values())],
            // 'genre_id' => 'required|exists:genres,genre_id',

            // 👇 Aquí validamos que genres sea un array
            'genres' => 'required|array|min:1',

            // 👇 Cada elemento del array debe ser un número entero y existir en la tabla genre
            'genres.*' => 'integer|exists:genres,genre_id',

            'description' => 'nullable|string',
            'release_date' => 'nullable|date',
            'cover_image' => 'nullable|string',
            'release_year' => 'nullable|int'
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'title.string' => 'El título debe ser una cadena de texto.',
            'title.max' => 'El título no debe exceder los 255 caracteres.',
            'type.required' => 'El tipo es obligatorio.',
            'type_programs_id' => 'required|exists:type_programs,type_programs_id',
            // 'type.in' => 'El tipo debe ser "movie" o "series".',
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

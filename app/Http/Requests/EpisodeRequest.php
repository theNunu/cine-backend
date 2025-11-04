<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EpisodeRequest extends FormRequest
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
            'season_id' => 'required|exists:seasons,season_id',
            'episode_number' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'duration_minutes' => 'nullable|integer|min:1',
            'synopsis' => 'nullable|string',
            'video_url' => 'required|url'
        ];
    }

    public function messages(): array
    {

        return [
            'season_id.required' => 'El campo season_id es obligatorio.',
            'season_id.exists' => 'El season_id especificado no existe.',
            'episode_number.required' => 'El campo episode_number es obligatorio.',
            'episode_number.integer' => 'El campo episode_number debe ser un número entero.',
            'episode_number.min' => 'El campo episode_number debe ser al menos 1.',
            'title.required' => 'El campo title es obligatorio.',
            'title.string' => 'El campo title debe ser una cadena de texto.',
            'title.max' => 'El campo title no puede exceder los 255 caracteres.',
            'duration_minutes.integer' => 'El campo duration_minutes debe ser un número entero.',
            'duration_minutes.min' => 'El campo duration_minutes debe ser al menos 1.',
            'synopsis.string' => 'El campo synopsis debe ser una cadena de texto.',
            'video_url.required' => 'El campo video_url es obligatorio.',
            'video_url.url' => 'El campo video_url debe ser una URL válida.'
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

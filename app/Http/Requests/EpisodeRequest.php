<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}

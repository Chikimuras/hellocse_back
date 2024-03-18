<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PersonalityStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'deathdate' => ['nullable', 'date'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'created_by' => ['required', 'integer', 'gt:0'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}

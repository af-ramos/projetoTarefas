<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge(array_map(fn($value) => mb_strtoupper($value), $this->all()));
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
            'description' => 'required|string|max:255',
            'status_id' => 'required|integer|between:1,5'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is mandatory',
            'description.required' => 'Description is mandatory',
            'status.required' => 'Status is mandatory',
            'status.between' => 'Status is unavailable'
        ];
    }
}

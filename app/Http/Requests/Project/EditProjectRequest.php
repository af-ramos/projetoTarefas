<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $filtered = array_filter($this->all(), fn($value) => !is_null($value) && trim($value) !== '');
        $normalized = array_map(fn($value) => mb_strtoupper($value), $filtered);

        $this->merge($normalized);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status_id' => 'required|integer|exists:project_statuses,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is mandatory',
            'status.required' => 'Status is mandatory',
            'status.exists' => 'Status is unavailable'
        ];
    }
}

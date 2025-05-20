<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is mandatory'
        ];
    }
}

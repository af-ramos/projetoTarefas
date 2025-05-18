<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class EditTaskRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status_id' => 'required|integer|exists:task_statuses,id',
            'assigned_id' => 'nullable|integer|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is mandatory',
            'description.required' => 'Description is mandatory',
            'status_id.required' => 'Status is mandatory',
            'status_id.exists' => 'Status is unavailable',
            'assigned_id.exists' => 'User is unavailable'
        ];
    }
}

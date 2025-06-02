<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'notifications' => 'nullable|array|exists:notifications,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is mandatory',
            'email.required' => 'Email is mandatory',
            'email.email' => 'Email must be valid',
            'email.unique' => 'This email is already in use',
            'password.required' => 'Password is mandatory',
            'password.min' => 'Password must be at least 6 characters long',
            'notifications.exists' => 'Notification does not exist'
        ];
    }
}

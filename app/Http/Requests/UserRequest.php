<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $userId = $this->id;

        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'role_id' => ['required', 'integer'],
            'status' => ['required', 'string']
        ];

        if ($this->validatePassword) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        return $rules;
    }

    /**
     * Custmize the error messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 50 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match',
            'role_id.required' => 'Role is required',
            'status.required' => 'Status is required',
        ];
    }
}

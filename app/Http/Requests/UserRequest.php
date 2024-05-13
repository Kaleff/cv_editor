<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Minimums and maximums of acceptable variables for validation
     */
    private $password_min = 4;
    private $password_max = 20;
    private $name_min = 3;
    private $name_max = 50;
    private $email_max = 255;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ["required", "unique:users", "max:$this->email_max", "email"],
            'password' => ["required", "min:$this->password_min", "max:$this->password_max", "confirmed"],
            'name' => ["required", "min:$this->name_min ", "max:$this->name_max", "alpha_num:ascii"]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name for the document is required',
            'name.min' => "Name should be at least $this->name_min symbols long",
            'name.max' => "Name should be at most $this->name_max symbols long",
            'name.alpha_num' => 'Make sure that file name does not contain special or non-ascii characters ',
            'email.email' => 'Make sure to provide the valid e-mail',
            'emai.required' => 'Email is required for the registration',
            'email.unique' => 'Account with provided email already exists',
            'email.max' => "Email should be at most $this->email_max symbols long",
            'password.required' => 'Password is required to register',
            'password.min' => "Password should be at least $this->password_min symbols long",
            'password.max' => "Password should be at most $this->password_max symbols long"
        ];
    }
}

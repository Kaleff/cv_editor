<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
            'start_date' => 'date|required|before:today',
            'end_date' => 'date|after:start_day|before:today',
            'company' => 'required|min:5|max:40',
            'location' => 'min:5',
            'role' => 'required|min:5|max:50',
            'description' => 'min:20|required',
            'type'=> 'in:Full-time,Part-time,Internship'
        ];
    }
}

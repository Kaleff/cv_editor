<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
            'name' => 'required|min:5|max:100|alpha_num:ascii',
            'phone' => 'numeric|digits:11|nullable',
            'address' => 'min:5|max:100|nullable'
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
            'name.min' => 'Name should be at least 5 symbols long',
            'name.max' => 'Name should be at most 100 symbols long',
            'name.alpha_num'=> 'Make sure that file name does not contain special or non-ascii characters ',
            'phone.regex' => 'Please provide the phone in the format of "+(country_code)(phone)" ',
            'address.min' => 'Address should be at least 5 symbols long',
            'address.max' => 'Address should be at most 100 symbols long'
        ];
    }
}

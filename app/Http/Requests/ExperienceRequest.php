<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    /**
     * Minimums and maximums of acceptable variables for validation
     */
    private $company_min = 5;
    private $company_max = 50;
    private $location_min = 5;
    private $location_max = 50;
    private $role_min = 5;
    private $role_max = 50;
    private $description_min = 20;

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
            'start_date' => 'date|required|before:today',
            'end_date' => 'date|after:start_day|before:today|nullable',
            'company' => ['required', "min:$this->company_min", "max:$this->company_max"],
            'location' => ["min:$this->location_min" , "max:$this->location_max", 'nullable'],
            'role' => ["required", "min:$this->role_min", "max:$this->role_max"],
            'description' => ["min:$this->description_min", "required"],
            'type'=> 'in:Full-time,Part-time,Internship,Education|required'
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
            'company.required' => 'Name of a company is required',
            'company.min' => "Name of a company should be at least $this->company_min symbols long",
            'company.max' => "Name of a company should be at most $this->company_max symbols long",
            'location.min' => "Location name should be at least $this->location_min symbols long",
            'location.max' => "Location name should be at most $this->location_max symbols long",
            'role.required' => 'Role of the experience should be specified',
            'role.min' => "The role name should be at least $this->role_min symbols long",
            'role.max' => "The role name should be at most $this->role_max symbols long",
            'description.required' => 'Description of the experience is required',
            'description.min' => "Description of the experience should be at least $this->description_min symbols long",
            'type.in' => 'The choice is limited to Full-time, Part-time, Education and Internship',
            'type.required' => 'Type of the exprience should be specified',
            'start_date.date' => 'Please make sure the given date is valid',
            'end_date.date' => 'Please make sure the given date is valid',
            'start_date.required' => 'The start date is required',
            'start_date.before' => 'The start date should be eariler than today',
            'end_date.before' => 'The end date should be earlier than today',
            'end_date.after' => 'The end date should be later than the start date'
        ];
    }
}

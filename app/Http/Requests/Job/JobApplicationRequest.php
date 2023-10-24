<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
            'expected_salary' => ['required', 'numeric', 'min:0', 'max:500000'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2000'],
        ];
    }
}

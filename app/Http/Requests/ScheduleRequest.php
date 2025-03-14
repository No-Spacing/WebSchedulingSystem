<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'title' => 'required',
            'roomNo' => 'required',
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'roomNo.required' => 'The room number is required.',
        ];
    }   
}

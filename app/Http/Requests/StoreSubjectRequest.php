<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'code' => 'required|unique:subjects|string',
            'name' => 'required|unique:subjects|string',
            'weekly_hours' => 'required|integer|min:0',
            'shift_time' => 'required|in:Mañana,Tarde',
            'classroom' => 'required|integer|min:0',
            'user_id' => 'nullable|exists:users,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'department_id' => 'nullable|exists:departments,id',
        ];
    }
}

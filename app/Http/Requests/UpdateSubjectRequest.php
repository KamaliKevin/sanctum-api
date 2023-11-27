<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'code' => 'sometimes|required|string|unique:subjects,code,'.$this->route('subject'),
            'name' => 'sometimes|required|string|unique:subjects,name,'.$this->route('subject'),
            'weekly_hours' => 'sometimes|required|integer|min:0',
            'shift_time' => 'sometimes|required|in:Mañana,Tarde',
            'classroom' => 'sometimes|required|integer|min:0',
            'user_id' => 'sometimes|nullable|exists:users,id',
            'specialty_id' => 'sometimes|nullable|exists:specialties,id',
            'department_id' => 'sometimes|nullable|exists:departments,id'
        ];
    }
}

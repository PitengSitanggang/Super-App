<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $student = $this->route('student');
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 
                'email',
                Rule::unique('users', 'email')->ignore($student->user_id),
            ],
            'password' => 'nullable|string|min:8',
            'student_number' => [
                'required', 
                'string',
                Rule::unique('students', 'student_number')->ignore($student->id),
            ],
            'gender' => 'required|in:male,female',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone_number' => 'nullable|string|max:20',
            'grade' => 'required|string|max:50',
            'major' => 'required|string|max:50',
        ];
    }
}

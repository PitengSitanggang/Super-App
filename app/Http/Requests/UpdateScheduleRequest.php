<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'class_name' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'in:Monday,Tuesday,Wednesday,Thursday,Friday'],
            'period' => ['required', 'array', 'min:1'],
            'period.*' => ['integer', 'min:1', 'max:7'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $className = $this->class_name;
            $day = $this->day;
            $periods = $this->period;

            if ($className && $day && is_array($periods)) {
                $query = \App\Models\Schedule::where('class_name', $className)
                    ->where('day', $day)
                    ->whereIn('period', $periods);

                if ($this->route('schedule')) {
                    $query->where('id', '!=', $this->route('schedule')->id);
                }

                $existing = $query->pluck('period')->toArray();

                if (!empty($existing)) {
                    $validator->errors()->add('period', 'Schedule for period ' . implode(', ', $existing) . ' already exists for this class on this day.');
                }
            }
        });
    }
}

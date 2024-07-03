<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'clock_in_time' => 'required|date_format:H:i',
            'clock_out_time' => 'nullable|date_format:H:i|after:clock_in_time',
        ];
    }
}

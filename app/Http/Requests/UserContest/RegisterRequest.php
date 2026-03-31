<?php

namespace App\Http\Requests\UserContest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'uid'       => 'required|size:6',
            'full_name' => 'required',
            'phone'     => 'required|unique:contest_users',
            'email'     => 'required|unique:contest_users',
            'city'      => 'required',
            'review'    => 'required',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
    }
}

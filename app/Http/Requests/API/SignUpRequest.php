<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:191',
            'last_name'  => 'required|string|max:191',
            'birthdate'  => 'required|date',
            'email'      => 'required|string|email|unique:users,email',
            'mobile'     => 'nullable|string|unique:users,mobile',
            'password' 	 => 'required|string|regex:/^\S*$/u|min:6',
            'unique_id'  => 'required|string|max:191',
            'fcm_token'  => 'nullable|string',
        ];
    }
}

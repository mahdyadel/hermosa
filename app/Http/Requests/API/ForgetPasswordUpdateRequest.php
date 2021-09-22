<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordUpdateRequest extends FormRequest
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
            'email'      => 'required|email|exists:users,email,type,"USER"',
            'reset_code' => 'required',
            'password'   => 'required|string|regex:/^\S*$/u|min:6',
            'unique_id'  => 'required|string',
        ];
    }
}

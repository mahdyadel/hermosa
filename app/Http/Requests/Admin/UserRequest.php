<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->method() == 'POST')
        {
            return [
                'first_name'  => 'required|string|max:191',
                'last_name'   => 'required|string|max:191',
                'email'       => 'required|email|unique:users,email',
                'mobile'      => 'nullable|string|max:191',
                'city_id'     => 'nullable|integer|exists:cities,id',
                'birthdate'   => 'nullable|date',
            ];
        }
        else if($this->method() == 'PUT')
        {
            return [
                'first_name'  => 'required|string|max:191',
                'last_name'   => 'required|string|max:191',
                'email'       => 'required|email|unique:users,email,'.$this->route('user'),
                'mobile'      => 'nullable|string|max:191',
                'city_id'     => 'nullable|integer|exists:cities,id',
                'birthdate'   => 'nullable|date',
                'is_blocked'  => 'nullable|boolean',
            ];
        }

        return [
            //
        ];
    }
}

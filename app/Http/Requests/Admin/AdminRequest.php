<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                'name'        => 'required|string|max:191',
                'email'       => 'required|email|unique:users,email',
                'mobile'      => 'nullable|string|max:191',
                'password'    => 'required|confirmed|min:6',
            ];
        }
        else if($this->method() == 'PUT')
        {
            return [
                'name'        => 'required|string|max:191',
                'email'       => 'required|email|unique:users,email,'.$this->route('admin'),
                'mobile'      => 'nullable|string|max:191',
                'password'    => 'nullable|confirmed|min:6',
            ];
        }

        return [
            //
        ];
    }
}

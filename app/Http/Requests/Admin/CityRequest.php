<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    if($this->method() == 'POST') {
      return [
        'name_ar'    => 'required|string|max:191',
        'name_en'    => 'required|string|max:191',
      ];
    }
    else if($this->method() == 'PUT')
    {
      return [
        'name_ar'    => 'required|string|max:191',
        'name_en'    => 'required|string|max:191',
        'is_active'  => 'required|in:0,1'
      ];
    }
    return [];
  }
}

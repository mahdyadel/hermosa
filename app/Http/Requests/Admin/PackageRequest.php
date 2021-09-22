<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
  public function rules()
  {
    if($this->method() == 'POST') {
      return [
        'name_ar'        => 'required|string|max:191',
        'name_en'        => 'required|string|max:191',
        'description_ar' => 'nullable|string',
        'description_e'  => 'nullable|string',
        'color'          => 'required|string|max:191',
        'amount'         => 'required|integer',
        'duration'       => 'required|integer',
        'discount_percentage' => 'required|integer',
        'images'         => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
      ];
    } else if($this->method() == 'PUT') {
      return [
        'name_ar'        => 'required|string|max:191',
        'name_en'        => 'required|string|max:191',
        'description_ar' => 'nullable|string',
        'description_e'  => 'nullable|string',
        'color'          => 'required|string|max:191',
        'amount'         => 'required|integer',
        'duration'       => 'required|integer',
        'discount_percentage' => 'required|integer',
        'images'         => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
      ];
    }

    return [];
  }
}

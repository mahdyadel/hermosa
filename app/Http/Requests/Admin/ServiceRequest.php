<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        'description_ar' => 'nullable|string|max:600',
        'description_en' => 'nullable|string|max:600',
        'image'          => 'nullable|mimes:jpg,jpeg,png,gif|max:4096',
        'icon'           => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:1096',

      ];
    } else if($this->method() == 'PUT') {
      return [
        'name_ar'        => 'required|string|max:191',
        'name_en'        => 'required|string|max:191',
        'description_ar' => 'nullable|string|max:600',
        'description_en' => 'nullable|string|max:600',
        'image'          => 'nullable|mimes:jpg,jpeg,png,gif|max:4096',
        'icon'           => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:1096',
      ];
    }

    return [];
  }
}

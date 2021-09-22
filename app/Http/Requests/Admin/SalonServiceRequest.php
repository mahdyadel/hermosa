<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SalonServiceRequest extends FormRequest
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
        'service_id' => 'required|exists:services,id',
        'name_ar'    => 'required|string|max:191',
        'name_en'    => 'required|string|max:191',
        'price'      => 'required|string|max:191',
        'minutes'    => 'required|string|max:191',
        'home_service'       => 'nullable|boolean',
      ];
    } else if($this->method() == 'PUT') {
      return [
        'service_id' => 'required|exists:services,id',
        'name_ar'    => 'required|string|max:191',
        'name_en'    => 'required|string|max:191',
        'price'      => 'required|string|max:191',
        'minutes'    => 'required|string|max:191',
        'home_service'       => 'nullable|boolean',
      ];
    }

    return [];
  }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SalonServiceOfferRequest extends FormRequest
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
        'salon_service_id' => 'required|exists:salon_services,id',
        'new_price'        => 'required|integer',
        'hours'            => 'required|integer',
      ];
    } else if($this->method() == 'PUT') {
      return [
        'salon_service_id' => 'required|exists:salon_services,id',
        'new_price'        => 'required|integer',
        'hours'            => 'required|integer',
      ];
    }

    return [];
  }
}

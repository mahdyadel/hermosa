<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
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
        'code'           => 'required|unique:promocodes,code',
        'percentage'     => 'required|integer',
        'max_amount'     => 'required|integer',
        'max_use'        => 'required|integer',
        'expired_at'     => 'required|date',
      ];
    } else if($this->method() == 'PUT') {
      return [
        'code'           => 'required|unique:promocodes,code,'.$this->promocode,
        'percentage'     => 'required|integer',
        'max_amount'     => 'required|integer',
        'max_use'        => 'required|integer',
        'expired_at'     => 'required|date',
      ];
    }

    return [];
  }
}

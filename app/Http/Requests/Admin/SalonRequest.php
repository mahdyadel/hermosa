<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SalonRequest extends FormRequest
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
        'name_ar'                   => 'required|string|max:191',
        'name_en'                   => 'required|string|max:191',
        'photo'                     => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
        'logo'                      => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
        'phone'                     => 'required|string|max:191',
        'phone_2'                   => 'nullable|string|max:191',
        'bank_name'                 => 'required|string|max:191',
        'bank_account_number'       => 'required|string|max:191',
        'bank_account_number_pdf'   => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'bank_name_2'               => 'nullable|string|max:191',
        'bank_account_number_2'     => 'nullable|string|max:191',
        'bank_account_number_2_pdf' => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'tax_number'                => 'nullable|string|max:191',
        'tax_number_pdf'            => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'commercial_register'       => 'nullable|string|max:191',
        'commercial_register_pdf'   => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'percentage'                => 'required|numeric|between:0,100',   
        'deposit_percentage'        => 'required|numeric|between:0,100',
        'country_id'                => 'required|integer|exists:countries,id',
        'city_id'                   => 'required|integer|exists:cities,id',

      ];
    } else if($this->method() == 'PUT') {
      return [
        'name_ar'                   => 'required|string|max:191',
        'name_en'                   => 'required|string|max:191',
        'photo'                     => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
        'logo'                      => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
        'phone'                     => 'required|string|max:191',
        'phone_2'                   => 'nullable|string|max:191',
        'bank_name'                 => 'required|string|max:191',
        'bank_account_number'       => 'required|string|max:191',
        'bank_account_number_pdf'   => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'bank_name_2'               => 'nullable|string|max:191',
        'bank_account_number_2'     => 'nullable|string|max:191',
        'bank_account_number_2_pdf' => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'tax_number'                => 'nullable|string|max:191',
        'tax_number_pdf'            => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'commercial_register'       => 'nullable|string|max:191',
        'commercial_register_pdf'   => 'nullable|mimes:jpeg,jpg,png,gif,pdf|max:20000',
        'percentage'                => 'required|numeric|between:0,100',
        'deposit_percentage'        => 'required|numeric|between:0,100',
        'country_id'                => 'required|integer|exists:countries,id',
        'city_id'                   => 'required|integer|exists:cities,id',
      ];
    }
    return [];
  }
}

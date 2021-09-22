<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WorkingDayRequest extends FormRequest
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
        'working_day_id' => 'required|exists:working_days,id',
        'time_from'      => 'required|date_format:H:i',
        'time_to'        => 'required|date_format:H:i',
      ];
    } else if($this->method() == 'PUT') {
      return [
        'working_day_id' => 'required|exists:working_days,id',
        'time_from'      => 'required|date_format:H:i',
        'time_to'        => 'required|date_format:H:i',
      ];
    }

    return [];
  }
}

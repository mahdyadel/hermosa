<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Employee;

class EmployeeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Employee $employee)
    {
        return [
            'id'         => $employee->id,
            'name'       => $employee->name,
            'id'         => $employee->id,
            'salary'     => $employee->salary,
            'insurance'  => $employee->insurance,
            'gender'     => $employee->gender,
            'times'      => $employee->reservationServices->map(function($reservationService){
                return [
                    'date'     => $reservationService->date,
                    'time'     => $reservationService->time,
                    'minutes'  => $reservationService->salonService->minutes,
                ];
            }),
            'rate'       => $employee->rates_sum,
            'rates'      => $employee->rates->map(function($rate){
                    return [
                    'id'      => $rate->id,
                    'rate'    => $rate->rate,
                    'comment' => $rate->comment,
                    'user'    => [
                        'id'   => $rate->user->id,
                        'name' => $rate->user->name
                    ]
                ];
            })

        ];
    }
}

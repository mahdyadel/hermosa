<?php 

namespace App\Repositories;

use App\Models\EmployeeRate;

class EmployeeRateRepo extends Repository
{
    protected $model;

    public function __construct(EmployeeRate $model) {
        $this->model = $model;
    }

    public function filter($salonId, $employeeId, $search) {
        return $this->model
        ->when($search, function($query) use($search) {
            $query->where('rate', 'LIKE', '%'.$search.'%');
            $query->orWhere('comment', 'LIKE', '%'.$search.'%');
            $query->orWhereHas('user', function( $query ) use ( $search ){
                $query->where('name', 'LIKE', '%'.$search.'%');
                $query->orWhere('email', 'LIKE', '%'.$search.'%');
            });
        })
        ->where('salon_id', $salonId)
        ->where('employee_id', $employeeId)
        ->latest('id','desc')
        ->paginate(10);
    }

}
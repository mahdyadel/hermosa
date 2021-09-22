<?php 

namespace App\Repositories;

use App\Models\EmployeeSalonService;

class EmployeeSalonServiceRepo extends Repository
{
  protected $model;

  public function __construct(EmployeeSalonService $model) {
    $this->model = $model;
  }

  public function filter($salonId, $search, $status) {
    // return $this->model
    // ->where('salon_id', $salonId)
    // ->when($search, function($query) use($search) {
    //   $query->where('id', $search);
    //   $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
    //   $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
    //   $query->orWhere('price', 'LIKE', '%'.$search.'%');
    //   $query->orWhere('minutes', $search);
    // })
    // ->when($status, function($query) use($status) {
    //   $isActive = $status === "true" ? 1 : 0;
    //   $query->where('is_active', $isActive);
    // })
    // ->latest('id','desc')
    // ->paginate(10);
  }

}
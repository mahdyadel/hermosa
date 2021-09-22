<?php 

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepo extends Repository
{
  protected $model;

  public function __construct(Employee $model)
  {
    $this->model = $model;
  }

  public function filter($salonId, $search, $status)
  {
    return $this->model
    ->where('salon_id', $salonId)
    ->when($search, function($query) use($search)
    {
      $query->where('id', $search);
      $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
      $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
      $query->orWhere('gender', $search);
    })
    ->when($status, function($query) use($status) {
      $isActive = $status === "true" ? 1 : 0;
      $query->where('is_active', $isActive);
    })
    ->latest('id','desc')
    ->paginate(10);
  }


  public function find($id) {
    return $this->model
    ->where('id', $id)
    ->with('employeeSalonServices')
    ->withCount('rates')
    ->latest('id','desc')
    ->first();
}

  public function getAllBySalonId($salonId) {
    return $this->model->where('salon_id', $salonId)->get();
  }

}
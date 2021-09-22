<?php 

namespace App\Repositories;

use App\Models\WorkingDay;

class WorkingDayRepo extends Repository
{
  protected $model;

public function __construct(WorkingDay $model) {
    $this->model = $model;
  }

  public function filter($salonId) {
    return $this->model
    ->latest('id','asc')
    ->whereDoesntHave('salonWorkingDays', function($query) use($salonId) {
      $query->where('salon_id', $salonId);
    })
    ->paginate(10);
  }

}
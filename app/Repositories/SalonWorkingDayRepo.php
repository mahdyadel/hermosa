<?php 

namespace App\Repositories;

use App\Models\SalonWorkingDay;

class SalonWorkingDayRepo extends Repository
{
  protected $model;

  public function __construct(SalonWorkingDay $model) {
    $this->model = $model;
  }

  public function filter($salonId) {
    return $this->model
    ->where('salon_id', $salonId)
    ->latest('id','desc')
    ->with('workingDay')
    ->paginate(10);
  }

}
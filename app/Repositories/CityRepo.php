<?php 

namespace App\Repositories;

use App\Models\City;

class CityRepo extends Repository 
{
  protected $model;

  public function __construct(City $model) {
    $this->model = $model;
  }

  public function filter($countryId, $search, $status) {
   return $this->model
    ->where('country_id', $countryId)
    ->when($search, function($query) use($search) {
      $query->where('id', $search);
      $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
      $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
    })
    ->when($status, function($query) use($status) {
      $isActive = $status === "true" ? 1 : 0;
      $query->where('is_active', $isActive);
    })
    ->latest('id','desc')
    ->paginate(10);
  }

  public function getCitiesByCountryId($countryId) {
    return $this->model
    ->where('country_id', $countryId)
    ->get();
  }

}
<?php 

namespace App\Repositories;

use App\Models\Country;

class CountryRepo extends Repository 
{
  protected $model;

  public function __construct(Country $model) {
    $this->model = $model;
  }

  public function filter($search, $status) {
   return $this->model
    ->when($search, function($query) use($search) {
      $query->where('id', $search);
      $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
      $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
    })
    ->when($status, function($query) use($status) {
      $isActive = $status === "true" ? 1 : 0;
      $query->where('is_active', $isActive);
    })
    ->withCount('cities')
    ->latest('id','desc')
    ->paginate(10);
  }

}
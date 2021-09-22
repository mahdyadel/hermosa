<?php 

namespace App\Repositories;

use App\Models\Package;

class PackageRepo extends Repository 
{
  protected $model;

  public function __construct(Package $model) {
    $this->model = $model;
  }

  public function filter($search, $status) {
   return $this->model
    ->when($search, function($query) use($search) {
      $query->where('id', $search);
      $query->orWhere('duration', $search);
      $query->orWhere('amount', $search);      
      $query->orWhere('discount_percentage', $search);      
      $query->orWhere('color', $search);      
      $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
      $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
      $query->orWhere('description_ar', 'LIKE', '%'.$search.'%');
      $query->orWhere('description_en', 'LIKE', '%'.$search.'%');
    })
    ->when($status, function($query) use($status) {
      $isActive = $status === "true" ? 1 : 0;
      $query->where('is_active', $isActive);
    })
    ->latest('id','desc')
    ->paginate(10);
  }

}
<?php 

namespace App\Repositories;

use App\Models\Service;

class ServiceRepo extends Repository
{
  protected $model;

  public function __construct(Service $model) {
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
    ->latest('id','desc')
    ->paginate(10);
  }

  public function getActiveServices() {
    return $this->model->where('is_active', 1)->get();
  }

}
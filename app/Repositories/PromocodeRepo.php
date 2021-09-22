<?php 

namespace App\Repositories;

use App\Models\Promocode;

class PromocodeRepo extends Repository 
{
  protected $model;

  public function __construct(Promocode $model) {
    $this->model = $model;
  }

  public function filter($search, $status, $salonId = null) {
   return $this->model
    ->when($search, function($query) use($search) {
      $query->where('id', $search);
      $query->orWhere('code', $search);
      $query->orWhere('percentage', $search);
      $query->orWhere('max_amount', $search);      
      $query->orWhere('max_use', $search);      
      $query->orWhere('owner_Type', 'LIKE', '%'.$search.'%');
      $query->orWhere('expired_at', 'LIKE', '%'.$search.'%');

    })
    ->when($status, function($query) use($status) {
      $isActive = $status === "true" ? 1 : 0;
      $query->where('is_active', $isActive);
    })
    ->when($salonId, function($query) use($salonId) {
      $query->where('salon_id', $salonId);
    })
    ->latest('id','desc')
    ->paginate(10);
  }

}
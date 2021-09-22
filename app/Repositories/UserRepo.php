<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepo extends Repository
{
  protected $model;

  public function __construct(User $model) {
    $this->model = $model;
  }

  public function filter($search, $isBlocked) {
    return $this->model->where('type', 'USER')
    ->when($search, function($query) use($search) {
      $query->where('id', $search);
      $query->orWhere('name', 'LIKE', '%'.$search.'%');
      $query->orWhere('email', $search);
      $query->orWhere('mobile', $search);
    })
    ->when($isBlocked, function($query) use($isBlocked) {
      $query->where('is_blocked', $isBlocked == "true" ? 1 : 0);
    })
    ->with('city')
    ->latest('id','desc')
    ->paginate(10);
  }

  public function userByEmail($email) {
    return $this->model->where('email', $email)
    ->where('type', 'USER')
    ->first();
  }

}
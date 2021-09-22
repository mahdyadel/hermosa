<?php 

namespace App\Repositories;

use App\Models\Salon;

class SalonRepo extends Repository
{
    protected $model;

    public function __construct(Salon $model)
    {
        $this->model = $model;
    }

    public function filter($search, $status) {
        return $this->model
        ->when($search, function($query) use($search)
        {
            $query->where('id', $search);
            $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
            $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
            $query->orWhere('percentage', 'LIKE', '%'.$search.'%');
            $query->orWhere('phone', $search);
            $query->orWhere('phone_2', $search);
        })
        ->when($status, function($query) use($status) {
            $isActive = $status === "true" ? 1 : 0;
            $query->where('is_active', $isActive);
        })
        // ->withCount('services')
        // ->withCount('employees')
        ->withCount('reservations')
        ->latest('id','desc')
        ->paginate(10);
    }

    public function find($id) {
        return $this->model
        ->where('id', $id)
        ->withCount('services')
        ->withCount('employees')
        ->withCount('reservations')
        ->withCount('rates')
        ->withCount('offers')
        ->withCount('promocodes')
        ->latest('id','desc')
        ->first();
    }

}
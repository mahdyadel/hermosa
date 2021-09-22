<?php 

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepo extends Repository
{
    protected $model;

    public function __construct(Reservation $model) {
        $this->model = $model;
    }

    public function filter($salonId, $search, $status) {
        return $this->model
        ->where('salon_id', $salonId)
        ->when($search, function($query) use($search)
        {
            // $query->where('id', $search);
            // $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
            // $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
            // $query->orWhere('percentage', 'LIKE', '%'.$search.'%');
            // $query->orWhere('phone', $search);
            // $query->orWhere('phone_2', $search);
        })
        // ->when($status, function($query) use($status) {
        //     $isActive = $status === "true" ? 1 : 0;
        //     $query->where('is_active', $isActive);
        // })
        // ->withCount('services')
        // ->withCount('employees')
        // ->withCount('reservations')
        ->latest('id','desc')
        ->paginate(10);
    }

    public function sum($salonId, $search, $status) {
        return $this->model
        ->where('salon_id', $salonId)
        ->get();
    }


}
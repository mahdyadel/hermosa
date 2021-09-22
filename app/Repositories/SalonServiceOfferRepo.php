<?php 

namespace App\Repositories;

use App\Models\SalonServiceOffer;

class SalonServiceOfferRepo extends Repository
{
    protected $model;

    public function __construct(SalonServiceOffer $model) {
        $this->model = $model;
    }

    public function filter($salonId, $search, $status) {
        return $this->model
        ->where('salon_id', $salonId)
        ->when($search, function($query) use($search) {
            $query->where('new_price', $search);
            $query->orWhereHas('salonService', function($query) use($search) {
                $query->where('id', $search);
                $query->orWhere('name_ar', 'LIKE', '%'.$search.'%');
                $query->orWhere('name_en', 'LIKE', '%'.$search.'%');
            });
        })
        ->with('salonService')
        ->latest('id','desc')
        ->paginate(10);
    }

}
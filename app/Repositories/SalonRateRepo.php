<?php 

namespace App\Repositories;

use App\Models\SalonRate;

class SalonRateRepo extends Repository
{
    protected $model;

    public function __construct(SalonRate $model) {
        $this->model = $model;
    }

    public function filter($salonId, $search)
    {
        return $this->model
        ->when($search, function($query) use($search)
        {
            $query->where('rate', 'LIKE', '%'.$search.'%');
            $query->orWhere('comment', 'LIKE', '%'.$search.'%');
            $query->orWhereHas('user', function( $query ) use ( $search ){
                $query->where('name', 'LIKE', '%'.$search.'%');
                $query->orWhere('email', 'LIKE', '%'.$search.'%');
            });
        })
        ->where('salon_id', $salonId)
        ->latest('id','desc')
        ->paginate(10);
    }

}
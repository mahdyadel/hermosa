<?php 

namespace App\Repositories;

use App\Models\User;

class AdminRepo extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function filter($search, $salonId = null) {
        return $this->model
        ->when($search, function($query) use($search)
        {
            $query->where('id', $search);
            $query->orWhere('name', 'LIKE', '%'.$search.'%');
            $query->orWhere('email', $search);
            $query->orWhere('mobile', $search);
        })
        ->when($salonId == null, function($query) use($salonId) {
            $query->where('type', 'ADMIN');
        })
        ->when($salonId, function($query) use($salonId) {
            $query->where('salon_id', $salonId);
            $query->whereIn('type', ['SALON_OWNER', 'SALON_ADMIN']);
        })
        ->latest('id','desc')
        ->paginate(10);
    }

}
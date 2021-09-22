<?php 

namespace App\Repositories;

use App\Models\ReservationService;

class ReservationServiceRepo extends Repository
{
    protected $model;

    public function __construct(ReservationService $model) {
        $this->model = $model;
    }

}
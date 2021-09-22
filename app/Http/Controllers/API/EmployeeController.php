<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
// use App\Repositories\CountryRepo;
use App\Models\Employee;

// TRANSFORMERS
use App\Transformers\EmployeeTransformer;

class EmployeeController extends Controller
{
  protected $salonRepo;

  public function __construct(Employee $salonRepo) {
    // INITIATE SALON REPO
    $this->salonRepo = $salonRepo;
  }

    public function index(Request $request, $salonId, $salonServiceId) 
    {
        $date           = $request->date ? $request->date : date("Y-m-d");
        $employees      = Employee::where('salon_id', $salonId)
        ->where('is_active', 1)
        ->whereHas('employeeSalonServices', function($query) use($salonServiceId) {
            $query->where('salon_service_id', $salonServiceId);
        })
        ->with(['reservationServices' => function($query) use($date) {
            $query->where('date', $date);
            $query->with('salonService');
        }, 'rates'])
        ->get();

        $employees = fractal($employees, new EmployeeTransformer())->toArray();

        return response()->json($employees);
    }

    function getServiceScheduleSlots($duration, $start ,$end) {
        $start_time = date('H:i', strtotime($start));
        $end_time   = date('H:i', strtotime($end));
        $i=0;
        while(strtotime($start_time) <= strtotime($end_time)){
            $start = $start_time;
            $end   = date('H:i',strtotime('+'.$duration.' minutes', strtotime($start_time)));
            $start_time = date('H:i',strtotime('+'.$duration.' minutes',strtotime($start_time)));
            $i++;
            if(strtotime($start_time) <= strtotime($end_time)){
                $time[$i]['start'] = $start;
                $time[$i]['end'] = $end;
            }
        }
        return $time;
    }

}
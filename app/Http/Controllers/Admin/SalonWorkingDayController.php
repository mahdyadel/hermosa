<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\WorkingDayRequest;

// REPOSITORIES
use App\Repositories\WorkingDayRepo;
use App\Repositories\SalonWorkingDayRepo;

class SalonWorkingDayController extends Controller
{
  private $workingDayRepo;
  private $salonWorkingDayRepo;

  public function __construct(WorkingDayRepo $workingDayRepo, SalonWorkingDayRepo $salonWorkingDayRepo) {
    // INITIATE REPOS
    $this->workingDayRepo = $workingDayRepo;
    $this->salonWorkingDayRepo = $salonWorkingDayRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_EMPLOYEES')->only(['create', 'store']);
    $this->middleware('permission:READ_EMPLOYEES')->only('index');
    $this->middleware('permission:UPDATE_EMPLOYEES')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_EMPLOYEES')->only('destroy');
  }

  public function index(Request $request, $salonId) {
    $salonWorkingDays = $this->salonWorkingDayRepo->filter($salonId, $request->search);
    return view('salon-working-day.index', compact('salonWorkingDays'));
  }
  
  public function create($salonId) {
    $workingDays = $this->workingDayRepo->filter($salonId);
    return view('salon-working-day.create', compact('workingDays'));
  }
  
  public function store(WorkingDayRequest $request, $salonId) {        
    // INITIALIZATION
    $data = $request->all();
    $data['salon_id'] = $salonId;

    $salonWeekDay = $this->salonWorkingDayRepo->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/working-days")
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($salonId, $id) {
    $salonWorkingDay = $this->salonWorkingDayRepo->find($id);
    $workingDays = $this->workingDayRepo->filter($salonId);
    return view('salon-working-day.edit', compact('salonWorkingDay', 'workingDays'));
  }

  public function update(WorkingDayRequest $request, $salonId, $id) {
    // INITIALIZATION
    $data = $request->all();

    $salonWorkingDay = $this->salonWorkingDayRepo->find($id);
    $salonWorkingDay->update($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/working-days")
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($salonId, $id) {
    $salonWorkingDay = $this->salonWorkingDayRepo->find($id);
    $salonWorkingDay->delete();

    return redirect("/salons/$salonId/working-days")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

}
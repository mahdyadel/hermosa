<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReservationRequest;

// REPOSITORIES
use App\Repositories\ReservationRepo;
use App\Repositories\ReservationServiceRepo;

use App\Exports\ExportReservations;
use Maatwebsite\Excel\Facades\Excel;

class ReservationController extends Controller
{
  protected $reservationRepo;
  protected $reservationServiceRepo;

  public function __construct(ReservationRepo $reservationRepo, ReservationServiceRepo $reservationServiceRepo) {
    // INITIATE REPOS
    $this->reservationRepo        = $reservationRepo;
    $this->reservationServiceRepo = $reservationServiceRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_RESERVATIONS')->only(['create', 'store']);
    $this->middleware('permission:READ_RESERVATIONS')->only('index');
    $this->middleware('permission:UPDATE_RESERVATIONS')->only(['edit', 'update']);
    $this->middleware('permission:DELETE_RESERVATIONS')->only('destroy');
  }

  public function index(Request $request, $salondId) {
    $sum = $this->reservationRepo->sum($salondId, $request->search, $request->active);
    $this->rightSalonPermission($salondId);
    $reservations = $this->reservationRepo->filter($salondId, $request->search, $request->active);
    return view('reservation.index', compact('reservations', 'sum'));
  }

  public function show($salondId, $reservationId) {
    $this->rightSalonPermission($salondId);
    $reservation = $this->reservationRepo->where('id', $reservationId)
    ->where('salon_id', $salondId)
    ->firstOrFail();
    return view('reservation.show', compact('reservation'));
  }

  public function create($salondId) {
    $this->rightSalonPermission($salondId);
    $services = $this->serviceRepo->get();
    return view('reservation.create', compact('services'));
  }

  public function store(PromocodeRequest $request, $salondId) {    
    $this->rightSalonPermission($salondId);

    // INITIALIZATION
    $data = $request->all();
    $data['is_active']  = 1;
    $data['owner_type'] = auth()->user()->type == "SALON" ? "SALON" : "HERMOSA";
    $data['salon_id']   = auth()->user()->salon_id;

    // CREATE NEW COUNTRY 
    $promocode = $this->promocodeRepo->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/promocodes')
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($salondId, $reservationId) {
    $this->rightSalonPermission($salondId);

    $reservation = $this->reservationRepo->where('id', $reservationId)
    ->where('salon_id', $salondId)
    ->firstOrFail();

    return view('reservation.edit', compact('reservation'));
  }

  public function update(PromocodeRequest $request, $salondId, $reservationId) {   
    $this->rightSalonPermission($salondId);

    $reservation = $this->reservationRepo->where('id', $reservationId)
    ->where('salon_id', $salondId)
    ->firstOrFail();

    // UPDATE DATA
    $reservation->update($request->all());

    // RETURN TO VIEW WITH SUCESS MESSAGE
    return redirect('/promocodes')
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {
    $promocode = $this->promocodeRepo->find($id);
    $promocode->delete();
    // REDIRECT WITH SUCCESS MESSAGE
    return redirect('/promocodes')
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $salondId, $reservationId) {
    $this->rightSalonPermission($salondId);

    $reservation = $this->reservationRepo->where('id', $reservationId)
    ->where('salon_id', $salondId)
    ->firstOrFail();

    // UPDATE STATUS
    $reservation->status = $request->status;
    $reservation->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($reservation->status == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

  public function bill(Request $request, $salondId, $reservationId) {
    $reservation = $this->reservationRepo->where('id', $reservationId)
    ->where('salon_id', $salondId)
    ->firstOrFail();

    return view('reservation.bills', compact('reservation'));
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

  public function export() {
    return Excel::download(new ExportReservations, 'reservations.xlsx');
  }

}
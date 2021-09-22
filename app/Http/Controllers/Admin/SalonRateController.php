<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
use App\Repositories\SalonRateRepo;

class SalonRateController extends Controller {

  private $salonRateRepo;

  public function __construct(SalonRateRepo $salonRateRepo) {
    // INITIATE REPOS
    $this->salonRateRepo = $salonRateRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:READ_SALON_RATES')->only('index');
    $this->middleware('permission:DELETE_SALON_RATES')->only('destroy');
  }

  public function index(Request $request, $salonId) {
    $this->rightSalonPermission($salonId);
    $salonRates = $this->salonRateRepo->filter($salonId, $request->search);
    return view('salon-rate.index', compact('salonRates'));
  }
  
  public function destroy($salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonRate = $this->salonRateRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();

    $salonRate->delete();

    return redirect("/salons/$salonId/rates")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

}
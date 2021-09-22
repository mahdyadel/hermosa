<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SalonServiceOfferRequest;

// REPOSITORIES
use App\Repositories\SalonServiceOfferRepo;
use App\Repositories\SalonServiceRepo;
use App\Repositories\ServiceRepo;

class SalonServiceOfferController extends Controller
{
  private $SalonServiceOfferRepo;
  private $salonServiceRepo;
  private $serviceRepo;

  public function __construct(SalonServiceOfferRepo $salonServiceOfferRepo, SalonServiceRepo $salonServiceRepo, ServiceRepo $serviceRepo) {
    // INITIATE REPOS
    $this->salonServiceOfferRepo = $salonServiceOfferRepo;
    $this->salonServiceRepo      = $salonServiceRepo;
    $this->serviceRepo           = $serviceRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_OFFERS')->only(['create', 'store']);
    $this->middleware('permission:READ_OFFERS')->only('index');
    $this->middleware('permission:UPDATE_OFFERS')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_OFFERS')->only('destroy');
  }

  public function index(Request $request, $salonId) {
    $this->rightSalonPermission($salonId);
    $salonServiceOffers = $this->salonServiceOfferRepo->filter($salonId, $request->search, $request->active);
    return view('salon-service-offer.index', compact('salonServiceOffers'));
  }

  public function create($salonId) {
    $this->rightSalonPermission($salonId);
    $salonServices = $this->salonServiceRepo->getBySalonId($salonId);
    return view('salon-service-offer.create', compact('salonServices'));
  }

  public function store(SalonServiceOfferRequest $request, $salonId) {  
    $this->rightSalonPermission($salonId);
  
    // INITIALIZATION
    $data = $request->all();
    $data['salon_id']  = $salonId;

    // CREATE NEW USER 
    $salonServiceOffer = $this->salonServiceOfferRepo->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/offers")
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonServiceOffer = $this->salonServiceOfferRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();

    $salonServices = $this->salonServiceRepo->getBySalonId($salonId);
    return view('salon-service-offer.edit', compact('salonServiceOffer', 'salonServices'));
  }

  public function update(SalonServiceOfferRequest $request, $salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonServiceOffer = $this->salonServiceOfferRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();

    // UPDATE
    $salonServiceOffer->update($request->all());

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/offers")
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonServiceOffer = $this->salonServiceOfferRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();

    $salonServiceOffer->delete();
    return redirect("/salons/$salonId/offers")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

}
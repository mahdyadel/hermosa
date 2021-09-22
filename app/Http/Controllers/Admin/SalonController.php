<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SalonRequest;

use Exception;

// REPOSITORIES
use App\Repositories\SalonRepo;
use App\Repositories\CountryRepo;
use App\Repositories\CityRepo;

use App\Exports\ExportSalons;
use Maatwebsite\Excel\Facades\Excel;

class SalonController extends Controller
{
  private $salonRepo;
  private $countryRepo;

  public function __construct(SalonRepo $salonRepo, CountryRepo $countryRepo) {
    // INITIATE USER REPO
    $this->salonRepo   = $salonRepo;
    $this->countryRepo = $countryRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_SALONS')->only(['create', 'store']);
    $this->middleware('permission:READ_SALONS')->only('index');
    $this->middleware('permission:UPDATE_SALONS')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_SALONS')->only('destroy');
  }

  public function index(Request $request) {
    if(in_array(auth()->user()->type, ['SALON_OWNER', 'SALON_ADMIN'])) {
      abort(403, 'Access denied');
    }
    $salons = $this->salonRepo->filter($request->search, $request->active);
    return view('salon.index', compact('salons'));
  }

  public function show($id) {
    $this->rightSalonPermission($id);
    $salon = $this->salonRepo->find($id);
    return view('salon.show', compact('salon'));
  }

  public function edit($id, CityRepo $cityRepo) {
    $this->rightSalonPermission($id);
    $salon     = $this->salonRepo->find($id);
    $countries = $this->countryRepo->get();
    $cities    = $cityRepo->getCitiesByCountryId($salon->country_id);
    return view('salon.edit', compact('salon', 'countries', 'cities'));
  }

  public function create() {
    $countries = $this->countryRepo->get();
    return view('salon.create', compact('countries'));
  }

  public function store(SalonRequest $request) {        
    // INITIALIZATION
    $data = $request->all();
    $data['is_active'] = 1;

    if ($request->hasFile('photo')) {
      $image = str_replace(" ", "-", $data['name_en'])."-image.".$request->photo->extension();
      $data['main_photo'] = $image;
      $request->photo->storeAs('/public/salons', $image);
    }

    if ($request->hasFile('logo')) {
      $logo = str_replace(" ", "-", $data['name_en'])."-logo.".$request->logo->extension();
      $data['logo'] = $logo;
      $request->logo->storeAs('/public/salons', $logo);
    }

    if ($request->hasFile('bank_account_number_pdf')) {
      $bank_account_number_pdf = str_replace(" ", "-", $data['name_en'])."-bank-account-number.".$request->bank_account_number_pdf->extension();
      $data['bank_account_number_pdf'] = $bank_account_number_pdf;
      $request->bank_account_number_pdf->storeAs('/public/salons', $bank_account_number_pdf);
    }

    if ($request->hasFile('bank_account_number_2_pdf')) {
      $bank_account_number_2_pdf = str_replace(" ", "-", $data['name_en'])."-bank-account-number-2.".$request->bank_account_number_2_pdf->extension();
      $data['bank_account_number_2_pdf'] = $bank_account_number_2_pdf;
      $request->bank_account_number_2_pdf->storeAs('/public/salons', $bank_account_number_2_pdf);
    }

    if ($request->hasFile('tax_number_pdf')) {
      $tax_number_pdf = str_replace(" ", "-", $data['name_en'])."-tax-number.".$request->tax_number_pdf->extension();
      $data['tax_number_pdf'] = $tax_number_pdf;
      $request->tax_number_pdf->storeAs('/public/salons', $tax_number_pdf);
    }

    if ($request->hasFile('commercial_register_pdf')) {
      $commercial_register_pdf = str_replace(" ", "-", $data['name_en'])."-commercial-register.".$request->commercial_register_pdf->extension();
      $data['commercial_register_pdf'] = $commercial_register_pdf;
      $request->commercial_register_pdf->storeAs('/public/salons', $commercial_register_pdf);
    }

    // CREATE NEW USER 
    $this->salonRepo->create($data);
    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/salons')
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function update(SalonRequest $request, $id) {
    $this->rightSalonPermission($id);
    // INITIALIZATION
    $data = auth()->user()->type === "ADMIN" ? $request->all() : $request->expect('percentage');

    // FIND THE USER
    $salon = $this->salonRepo->find($id);

    if ($request->hasFile('photo')) {
      $image = str_replace(" ", "-", $data['name_en'])."-image.".$request->photo->extension();
      $data['main_photo'] = $image;
      $request->photo->storeAs('/public/salons', $image);
    }

    if ($request->hasFile('logo')) {
      $logo = str_replace(" ", "-", $data['name_en'])."-logo.".$request->logo->extension();
      $data['logo'] = $logo;
      $request->logo->storeAs('/public/salons', $logo);
    }

    if ($request->hasFile('bank_account_number_pdf')) {
      $bank_account_number_pdf = str_replace(" ", "-", $data['name_en'])."-bank-account-number.".$request->bank_account_number_pdf->extension();
      $data['bank_account_number_pdf'] = $bank_account_number_pdf;
      $request->bank_account_number_pdf->storeAs('/public/salons', $bank_account_number_pdf);
    }

    if ($request->hasFile('bank_account_number_2_pdf')) {
      $bank_account_number_2_pdf = str_replace(" ", "-", $data['name_en'])."-bank-account-number-2.".$request->bank_account_number_2_pdf->extension();
      $data['bank_account_number_2_pdf'] = $bank_account_number_2_pdf;
      $request->bank_account_number_2_pdf->storeAs('/public/salons', $bank_account_number_2_pdf);
    }

    if ($request->hasFile('tax_number_pdf')) {
      $tax_number_pdf = str_replace(" ", "-", $data['name_en'])."-tax-number.".$request->tax_number_pdf->extension();
      $data['tax_number_pdf'] = $tax_number_pdf;
      $request->tax_number_pdf->storeAs('/public/salons', $tax_number_pdf);
    }

    if ($request->hasFile('commercial_register_pdf')) {
      $commercial_register_pdf = str_replace(" ", "-", $data['name_en'])."-commercial-register.".$request->commercial_register_pdf->extension();
      $data['commercial_register_pdf'] = $commercial_register_pdf;
      $request->commercial_register_pdf->storeAs('/public/salons', $commercial_register_pdf);
    }

    // UPDATE USER DATA
    $salon->update($data);
    // RETURN TO VIEW WITH SUCCESS MESSAGE
    if(in_array(auth()->user()->type , ['SALON_OWNER', 'SALON_ADMIN'])) {
      return redirect("/salons/".auth()->user()->salon_id)
      ->with(['success' => __('messages.has_been_updated')]);
    }
    return redirect('/salons')
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {
    $this->rightSalonPermission($id);
    $salon = $this->salonRepo->find($id);
    $salon->delete();
    return redirect('/salons')->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $id) {
    $this->rightSalonPermission($id);

    // UPDATE SALON STATUS
    $salon = $this->salonRepo->find($id);
    $salon->is_active = $request->status;
    $salon->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($salon->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

  public function bills(Request $request, $salondId) {
    $salon = $this->salonRepo->find($salondId);
    return view('salon.bills', compact('salon'));
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

  public function export() {
    return Excel::download(new ExportSalons, 'salons.xlsx');
  }

}
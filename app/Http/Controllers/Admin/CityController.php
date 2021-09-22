<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CityRequest;

// REPOSITORIES
use App\Repositories\CityRepo;
use App\Repositories\CountryRepo;

class CityController extends Controller
{
  protected $cityRepo;
  protected $countryRepo;

  public function __construct(CityRepo $cityRepo, CountryRepo $countryRepo) {
    // INITIATE REPOS
    $this->cityRepo    = $cityRepo;
    $this->countryRepo = $countryRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth')->except('json');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_CITIES')->only(['create', 'store']);
    $this->middleware('permission:READ_CITIES')->only('index');
    $this->middleware('permission:UPDATE_CITIES')->only(['edit', 'update']);
    $this->middleware('permission:DELETE_CITIES')->only('destroy');
  }

  public function index(Request $request, $countryId) {
    $cities = $this->cityRepo->filter($countryId, $request->search, $request->active);
    return view('city.index', compact('cities'));
  }

  public function create() {
    $countries = $this->countryRepo->get();
    return view('city.create', compact('countries'));
  }

  public function store(CityRequest $request, $countryId) {        
    // INITIALIZATION
    $data = $request->all();
    $data['country_id'] = $countryId;
    $data['is_active'] = 1;
    
    // CREATE NEW CITY 
    $city = $this->cityRepo->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/countries/$countryId/cities")
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($countryId, $id) {
    $city = $this->cityRepo->find($id);
    $countries = $this->countryRepo->get();
    return view('city.edit', compact('city', 'countries'));
  }

  public function update(request $request, $countryId, $id) {   
    // INITIALIZATION
    $data = $request->except('country_id');

    // UPDATE CITY DATA
    $city = $this->cityRepo->update($data, $id);

    // RETURN TO VIEW WITH SUCESS MESSAGE
    return redirect("/countries/$countryId/cities")
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($countryId, $id) {
    // FIND CITY
    $city = $this->cityRepo->find($id);
    // DELETE
    $city->delete();
    // REDIRECT WITH SUCCESS MESSAGE
    return redirect("/countries/$countryId/cities")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $countryId, $id) {
    // UPDATE SALON STATUS
    $city = $this->cityRepo->find($id);
    $city->is_active = $request->status;
    $city->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($city->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

  public function json($countryId) {
    $cities = $this->cityRepo->getCitiesByCountryId($countryId);
    return response()->json($cities);
  }

}
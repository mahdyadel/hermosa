<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CountryRequest;

// REPOSITORIES
use App\Repositories\CountryRepo;

class CountryController extends Controller
{
  protected $countryRepo;

  public function __construct(CountryRepo $countryRepo) {
    // INITIATE USER REPO
    $this->countryRepo = $countryRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_COUNTRIES')->only(['create', 'store']);
    $this->middleware('permission:READ_COUNTRIES')->only('index');
    $this->middleware('permission:UPDATE_COUNTRIES')->only(['edit', 'update']);
    $this->middleware('permission:DELETE_COUNTRIES')->only('destroy');
  }

  public function index(Request $request) {
    $countries = $this->countryRepo->filter($request->search, $request->active);
    return view('country.index', compact('countries'));
  }

  public function create() {
    return view('country.create');
  }

  public function store(CountryRequest $request) {        
    // INITIALIZATION
    $data = $request->all();
    $data['is_active'] = 1;

    if ($request->hasFile('flag')) {
      $flag = str_replace(" ", "-", $data['name_en']).".".$request->flag->extension();
      $data['flag'] = $flag;
      $request->flag->storeAs('/public/countries', $flag);
    }

    // CREATE NEW COUNTRY 
    $country = $this->countryRepo->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/countries')
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($id) {
    $country = $this->countryRepo->find($id);
    return view('country.edit', compact('country'));
  }

  public function update(request $request, $id) {   
    // INITIALIZATION
    $data = $request->all();

    if ($request->hasFile('flag')) {
      $flag = str_replace(" ", "-", $data['name_en']).".".$request->flag->extension();
      $data['flag'] = $flag;
      $request->flag->storeAs('/public/countries', $flag);
    }

    // UPDATE COUNTRY DATA
    $country = $this->countryRepo->update($data, $id);

    // RETURN TO VIEW WITH SUCESS MESSAGE
    return redirect('/countries')
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {
    // FIND ADMIN
    $country = $this->countryRepo->find($id);
    // DELETE
    $country->delete();
    // REDIRECT WITH SUCCESS MESSAGE
    return redirect('/countries')
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $id) {
    // UPDATE SALON STATUS
    $country = $this->countryRepo->find($id);
    $country->is_active = $request->status;
    $country->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($country->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

}
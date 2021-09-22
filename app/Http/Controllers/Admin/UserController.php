<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;

// REPOSITORIES
use App\Repositories\UserRepo;
use App\Repositories\CountryRepo;
use App\Repositories\CityRepo;

class UserController extends Controller
{
  protected $user;
  protected $countryRepo;
  protected $cityRepo;

  public function __construct(UserRepo $userRepo, CountryRepo $countryRepo, CityRepo $cityRepo) {
    // INITIATE REPOS
    $this->user = $userRepo;
    $this->countryRepo = $countryRepo;
    $this->cityRepo = $cityRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_USERS')->only(['create', 'store']);
    $this->middleware('permission:READ_USERS')->only('index');
    $this->middleware('permission:UPDATE_USERS')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_USERS')->only('destroy');
  }

  public function index(Request $request) {
    $users = $this->user->filter($request->search, $request->is_blocked);
    return view('user.index', compact('users'));
  }

  public function edit($id) {
    $user = $this->user->find($id);
    $countries = $this->countryRepo->get();
    $cities = $this->cityRepo->getCitiesByCountryId($user->city->country_id);
    return view('user.edit', compact('user', 'countries', 'cities'));
  }

  public function create() {
    $countries = $this->countryRepo->get();
    return view('user.create', compact('countries'));
  }

  public function store(UserRequest $request) {        
    // INITIALIZATION
    $data = $request->all();
    $data['type'] = 'USER';

    // CREATE NEW USER 
    $this->user->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/users')
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function update(UserRequest $request, $id) {
    // INITIALIZATION
    $data = $request->except(['country_id', 'first_name', 'last_name']);
    // FIND THE USER
    $user = $this->user->find($id);

    $data['name'] = $request->first_name.' '.$request->last_name;
    
    // UPDATE USER DATA
    $user->update($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/users')->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {
    $user = $this->user->find($id);
    $user->delete();
    return redirect('/users')
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function block(Request $request, $id) {
    // FIND USER
    $user = $this->user->find($id);
    // UPDATE IS BLOCKED STATUS
    $user->is_blocked = $request->status;
    // SAVE CHANGES
    $user->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($user->is_blocked == 1 ? 'messages.has_been_blocked' : 'messages.has_been_unblocked');
    return back()->with(['success' => $message]);
  }

}
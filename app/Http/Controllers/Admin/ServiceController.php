<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ServiceRequest;

// REPOSITORIES
use App\Repositories\ServiceRepo;

class ServiceController extends Controller
{
  protected $serviceRepo;

  public function __construct(ServiceRepo $serviceRepo) {
    // INITIATE USER REPO
    $this->serviceRepo = $serviceRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_USERS')->only(['create', 'store']);
    $this->middleware('permission:READ_USERS')->only('index');
    $this->middleware('permission:UPDATE_USERS')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_USERS')->only('destroy');
  }

  public function index(Request $request) {
    $services = $this->serviceRepo->filter($request->search, $request->active);
    return view('service.index', compact('services'));
  }

  public function edit($id) {
    $service = $this->serviceRepo->find($id);
    return view('service.edit', compact('service'));
  }

  public function create() {
    return view('service.create');
  }

  public function store(ServiceRequest $request) {    
    // INITIALIZATION
    $data = $request->all();
    $data['is_active'] = 1;

    if ($request->hasFile('image')) {
      $image = str_replace(" ", "-", $data['name_en'])."-image.".$request->image->extension();
      $data['image'] = $image;
      $request->image->storeAs('/public/services', $image);
    }

    if ($request->hasFile('icon')) {
      $icon = str_replace(" ", "-", $data['name_en'])."-icon.".$request->icon->extension();
      $data['icon'] = $icon;
      $request->icon->storeAs('/public/services', $icon);
    }

    // CREATE NEW USER 
    $this->serviceRepo->create($data);
    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/services")
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function update(ServiceRequest $request, $id) {
    // INITIALIZATION
    $data = $request->all();
    // FIND THE USER
    $service = $this->serviceRepo->find($id);

    if ($request->hasFile('image')) {
      $image = str_replace(" ", "-", $data['name_en'])."-image.".$request->image->extension();
      $data['image'] = $image;
      $request->image->storeAs('/public/services', $image);
    }

    if ($request->hasFile('icon')) {
      $icon = str_replace(" ", "-", $data['name_en'])."-icon.".$request->icon->extension();
      $data['icon'] = $icon;
      $request->icon->storeAs('/public/services', $icon);
    }
    
    // UPDATE USER DATA
    $service->update($data);
    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/services")
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {
    $service = $this->serviceRepo->find($id);
    $service->delete();
    return redirect("/services")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $id) {
    // UPDATE SERVICE STATUS
    $service = $this->serviceRepo->find($id);
    $service->is_active = $request->status;
    $service->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($service->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

  public function json() {
    $services = $this->serviceRepo->getActiveServices();
    return response()->json($services);
  }

}
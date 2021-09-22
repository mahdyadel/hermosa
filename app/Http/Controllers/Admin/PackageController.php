<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackageRequest;

// REPOSITORIES
use App\Repositories\PackageRepo;
use App\Repositories\ServiceRepo;

class PackageController extends Controller
{
  protected $packageRepo;
  protected $serviceRepo;

  public function __construct(PackageRepo $packageRepo, ServiceRepo $serviceRepo) {
    // INITIATE REPOS
    $this->packageRepo = $packageRepo;
    $this->serviceRepo = $serviceRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_COUNTRIES')->only(['create', 'store']);
    $this->middleware('permission:READ_COUNTRIES')->only('index');
    $this->middleware('permission:UPDATE_COUNTRIES')->only(['edit', 'update']);
    $this->middleware('permission:DELETE_COUNTRIES')->only('destroy');
  }

  public function index(Request $request) {
    $packages = $this->packageRepo->filter($request->search, $request->active);
    return view('package.index', compact('packages'));
  }

  public function create() {
    $services = $this->serviceRepo->get();
    return view('package.create', compact('services'));
  }

  public function store(PackageRequest $request) {        
    // INITIALIZATION
    $data = $request->all();
    $data['is_active']  = 1;

    if ($request->hasFile('image')) {
      $image = str_replace(" ", "-", $data['name_en'])."-image.".$request->image->extension();
      $data['image'] = $image;
      $request->image->storeAs('/public/packages', $image);
    }

    // CREATE NEW COUNTRY 
    $package = $this->packageRepo->create($data);

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/packages')
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($id) {
    $package = $this->packageRepo->find($id);
    $services = $this->serviceRepo->get();
    return view('package.edit', compact('package', 'services'));
  }

  public function update(PackageRequest $request, $id) {   
    // INITIALIZATION
    $data = $request->all();

    if ($request->hasFile('image')) {
      $image = str_replace(" ", "-", $data['name_en'])."-image.".$request->image->extension();
      $data['image'] = $image;
      $request->image->storeAs('/public/packages', $image);
    }

    // UPDATE COUNTRY DATA
    $package = $this->packageRepo->update($data, $id);
    // RETURN TO VIEW WITH SUCESS MESSAGE
    return redirect('/packages')
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {
    $package = $this->packageRepo->find($id);
    $package->delete();
    // REDIRECT WITH SUCCESS MESSAGE
    return redirect('/packages')
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $id) {
    // UPDATE SALON STATUS
    $package = $this->packageRepo->find($id);
    $package->is_active = $request->status;
    $package->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($package->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

}
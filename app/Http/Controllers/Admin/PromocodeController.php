<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PromocodeRequest;

// REPOSITORIES
use App\Repositories\PromocodeRepo;
use App\Repositories\ServiceRepo;

class PromocodeController extends Controller
{
  protected $promocodeRepo;
  protected $serviceRepo;

  public function __construct(PromocodeRepo $promocodeRepo, ServiceRepo $serviceRepo) {
    // INITIATE REPOS
    $this->promocodeRepo = $promocodeRepo;
    $this->serviceRepo = $serviceRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_PROMOCODES')->only(['create', 'store']);
    $this->middleware('permission:READ_PROMOCODES')->only('index');
    $this->middleware('permission:UPDATE_PROMOCODES')->only(['edit', 'update']);
    $this->middleware('permission:DELETE_PROMOCODES')->only('destroy');
  }

  public function index(Request $request) {
    $user    = auth()->user();
    $salonId = in_array($user->type, ["SALON_OWNER", "SALON_ADMIN"]) && $user->salon_id ? $user->salon_id : null;
    
    $promocodes = $this->promocodeRepo->filter($request->search, $request->active, $salonId);
    return view('promocode.index', compact('promocodes'));
  }

  public function create() {
    $services = $this->serviceRepo->with(['salonServices' => function($query) {
      $query->where('salon_id', auth()->user()->salon_id);
    }])->get();
    return view('promocode.create', compact('services'));
  }

  public function store(PromocodeRequest $request) {    
  
    // INITIALIZATION
    $data = $request->all();
    $data['is_active']  = 1;
    $data['owner_type'] = in_array(auth()->user()->type, ['SALON_OWNER', 'SALON_ADMIN']) ? 'SALON' : 'HERMOSA';
    $data['salon_id']   = @auth()->user()->salon_id;

    // CREATE NEW COUNTRY 
    $promocode = $this->promocodeRepo->create($data);

    $mainServices = [];
    $subServices  = [];
    
    foreach($request->services_ids as $serviceId) {
      if(substr($serviceId, 0, 4 ) === "main") {
        $mainServices[] = explode("-", $serviceId)[1];
      } else {
        $mainId = explode("-", $serviceId)[1];
        $subServices[] = explode("-", $serviceId)[2];
        $mainServices  = array_filter($mainServices, function($value) use($mainId) {
          return $mainId != $value;
        });
      }
    }

    

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect('/promocodes')
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($id) {
    $promocode = $this->promocodeRepo->find($id);

    $this->rightSalonPermission($promocode->salon_id);

    $services = $this->serviceRepo->get();
    return view('promocode.edit', compact('promocode', 'services'));
  }

  public function update(PromocodeRequest $request, $id) {   

    $promocode = $this->promocodeRepo->find($id);

    $this->rightSalonPermission($promocode->salon_id);

    $promocode->update($request->all());

    // RETURN TO VIEW WITH SUCESS MESSAGE
    return redirect('/promocodes')
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($id) {

    $promocode = $this->promocodeRepo->find($id);

    $this->rightSalonPermission($promocode->salon_id);

    $promocode->delete();
    // REDIRECT WITH SUCCESS MESSAGE
    return redirect('/promocodes')
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $id) {

    // UPDATE SALON STATUS
    $promocode = $this->promocodeRepo->find($id);

    $this->rightSalonPermission($promocode->salon_id);

    $promocode->is_active = $request->status;
    $promocode->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($promocode->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

}
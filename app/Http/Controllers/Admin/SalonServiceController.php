<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SalonServiceRequest;

// REPOSITORIES
use App\Repositories\ServiceRepo;
use App\Repositories\SalonServiceRepo;
use App\Repositories\EmployeeRepo;
use App\Repositories\EmployeeSalonServiceRepo;
use App\Repositories\PackageRepo;

class SalonServiceController extends Controller
{
  private $serviceRepo;
  private $salonServiceRepo;
  private $employeeRepo;
  private $employeeSalonServiceRepo;
  private $packageRepo;

  public function __construct(ServiceRepo $serviceRepo, SalonServiceRepo $salonServiceRepo, EmployeeRepo $employeeRepo, EmployeeSalonServiceRepo $employeeSalonServiceRepo, PackageRepo $packageRepo) {
    // INITIATE REPOS
    $this->serviceRepo              = $serviceRepo;
    $this->salonServiceRepo         = $salonServiceRepo;
    $this->employeeRepo             = $employeeRepo;
    $this->employeeSalonServiceRepo = $employeeSalonServiceRepo;
    $this->packageRepo              = $packageRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_SALON_SERVICES')->only(['create', 'store']);
    $this->middleware('permission:READ_SALON_SERVICES')->only('index');
    $this->middleware('permission:UPDATE_SALON_SERVICES')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_SALON_SERVICES')->only('destroy');
  }

  public function index(Request $request, $salonId) {
    $this->rightSalonPermission($salonId);
    $services = $this->salonServiceRepo->filter($salonId, $request->search, $request->active);
    return view('salon-service.index', compact('services'));
  }

  public function create($salonId) {
    $this->rightSalonPermission($salonId);

    $services  = $this->serviceRepo->getActiveServices();
    $employees = $this->employeeRepo->getAllBySalonId($salonId);
    $packages  = $this->packageRepo->get();
    return view('salon-service.create', compact('services', 'employees', 'packages'));
  }

  public function store(SalonServiceRequest $request, $salonId) {    
    $this->rightSalonPermission($salonId);

    // INITIALIZATION
    $data = $request->all();
    $data['salon_id']     = $salonId;
    $data['is_active']    = 1;
    $data['home_service'] = $request->home_service ? 1 : 0;
    // CREATE NEW USER 
    $salonService = $this->salonServiceRepo->create($data);

    if($request->employees_ids) {
      foreach($request->employees_ids as $employeeId) {
        $servicesData[] = [
          "salon_id" => $salonId,
          "employee_id" => $employeeId,
          "salon_service_id" => $salonService->id
        ];
      }
  
      $this->employeeSalonServiceRepo->insert($servicesData);
    }

    if($request->packages_ids) {
      foreach($request->packages_ids as $packageId) {
        $packagesData[] = [
          "salon_id" => $salonId,
          "package_id" => $packageId,
          "salon_service_id" => $salonService->id
        ];
      }
  
      $salonService->packages()->insert($packagesData);
    }

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/services")
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function edit($salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonService = $this->salonServiceRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();

    $services = $this->serviceRepo->getActiveServices();
    $employees = $this->employeeRepo->getAllBySalonId($salonId);
    $packages  = $this->packageRepo->get();
    return view('salon-service.edit', compact('salonService', 'services', 'employees', 'packages'));
  }

  public function update(SalonServiceRequest $request, $salonId, $id) {
    $this->rightSalonPermission($salonId);

    // INITIALIZATION
    $data = $request->all();
    $data['salon_id']     = $salonId;
    $data['home_service'] = $request->home_service ? 1 : 0;

    // FIND SALON SERVICE
    $salonService = $this->salonServiceRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();
    
    // UPDATE SALON SERVICE DATA
    $salonService->update($data);

    if($request->employees_ids) {
      $salonService->employees()->delete();

      foreach($request->employees_ids as $employeeId) {
        $servicesData[] = [
          "salon_id" => $salonId,
          "employee_id" => $employeeId,
          "salon_service_id" => $salonService->id
        ];
      }
  
      $this->employeeSalonServiceRepo->insert($servicesData);
    }

    if($request->packages_ids) {
      $salonService->packages()->delete();

      foreach($request->packages_ids as $packageId) {
        $packagesData[] = [
          "salon_id" => $salonId,
          "package_id" => $packageId,
          "salon_service_id" => $salonService->id
        ];
      }
  
      $salonService->packages()->insert($packagesData);
    }

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/services")
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonService = $this->salonServiceRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();
    $salonService->delete();

    return redirect("/salons/$salonId/services")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $salonId, $id) {
    $this->rightSalonPermission($salonId);

    $salonService = $this->salonServiceRepo->where('id', $id)
    ->where('salon_id', $salonId)
    ->firstOrFail();

    // UPDATE SERVICE STATUS
    $salonService->is_active = $request->status;
    $salonService->save();

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($salonService->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_inactive');
    return back()->with(['success' => $message]);
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

}
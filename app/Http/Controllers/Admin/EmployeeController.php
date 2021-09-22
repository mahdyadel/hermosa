<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EmployeeRequest;

// REPOSITORIES
use App\Repositories\EmployeeRepo;
use App\Repositories\SalonServiceRepo;
use App\Repositories\EmployeeSalonServiceRepo;

class EmployeeController extends Controller
{
  private $employeeRepo;
  private $salonServiceRepo;
  private $employeeSalonServiceRepo;

  public function __construct(EmployeeRepo $employeeRepo, SalonServiceRepo $salonServiceRepo, EmployeeSalonServiceRepo $employeeSalonServiceRepo) {
    // INITIATE REPOS
    $this->employeeRepo             = $employeeRepo;
    $this->salonServiceRepo         = $salonServiceRepo;
    $this->employeeSalonServiceRepo = $employeeSalonServiceRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_EMPLOYEES')->only(['create', 'store']);
    $this->middleware('permission:READ_EMPLOYEES')->only('index');
    $this->middleware('permission:UPDATE_EMPLOYEES')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_EMPLOYEES')->only('destroy');
  }

  public function index(Request $request, $salonId) {
    $this->rightSalonPermission($salonId);
    $employees = $this->employeeRepo->filter($salonId, $request->search, $request->active);
    return view('employee.index', compact('employees'));
  }

  public function show($salonId, $id) {
    $this->rightSalonPermission($salonId);
    $employee = $this->employeeRepo->where('id', $id)->where('salon_id', $salonId)->firstOrFail();
    return view('employee.show', compact('employee'));
  }

  public function edit($salonId, $id) {
    $this->rightSalonPermission($salonId);
    $employee      = $this->employeeRepo->where('id', $id)->where('salon_id', $salonId)->firstOrFail();
    $salonServices = $this->salonServiceRepo->getBySalonId($salonId);
    return view('employee.edit', compact('employee', 'salonServices'));
  }

  public function create($salonId) {
    $this->rightSalonPermission($salonId);

    $salonServices = $this->salonServiceRepo->getBySalonId($salonId);
    return view('employee.create', compact('salonServices'));
  }

  public function store(EmployeeRequest $request, $salonId) {       
    $this->rightSalonPermission($salonId);
 
    // INITIALIZATION
    $data = $request->all();
    $data['salon_id'] = $salonId;
    $data['is_active'] = 1;

    if ($request->hasFile('photo')) {
      $image = str_replace(" ", "-", $salonId."-".$data['name_en']."".time()).".".$request->photo->extension();
      $data['photo'] = $image;
      $request->photo->storeAs('/public/employees', $image);
    }

    // CREATE NEW USER 
    $employee = $this->employeeRepo->create($data);

    if($request->salon_services_ids) {
      foreach($request->salon_services_ids as $salonServiceId) {
        $servicesData[] = [
          "salon_id" => $salonId,
          "employee_id" => $employee->id,
          "salon_service_id" => $salonServiceId
        ];
      }
  
      $this->employeeSalonServiceRepo->insert($servicesData);
    }

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/employees")
    ->with(['success' => __('messages.has_been_created')]);
  }

  public function update(EmployeeRequest $request, $salonId, $id) {
    $this->rightSalonPermission($salonId);

    $data = $request->all();

    // FIND THE EMPLOYEE
    $employee = $this->employeeRepo->where('id', $id)
    ->where('salon_id', $salonId)->firstOrFail();

    if ($request->hasFile('photo')) {
      $image = str_replace(" ", "-", $salonId."-".$data['name_en']."".time()).".".$request->photo->extension();
      $data['photo'] = $image;
      $request->photo->storeAs('/public/employees', $image);
    }
    
    // UPDATE USER DATA
    $employee->update($data);

    if($request->salon_services_ids) {
      $employee->employeeSalonServices()->delete();
      foreach($request->salon_services_ids as $salonServiceId) {
        $servicesData[] = [
          "salon_id" => $salonId,
          "employee_id" => $employee->id,
          "salon_service_id" => $salonServiceId
        ];
      }
      $this->employeeSalonServiceRepo->insert($servicesData);
    }

    // RETURN TO VIEW WITH SUCCESS MESSAGE
    return redirect("/salons/$salonId/employees")
    ->with(['success' => __('messages.has_been_updated')]);
  }

  public function destroy($salonId, $id) {
    $this->rightSalonPermission($salonId);

    $employee = $this->employeeRepo->where('id', $id)
    ->where('salon_id', $salonId)->firstOrFail();

    $employee->delete();

    return redirect("/salons/$salonId/employees")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

  public function status(Request $request, $salonId, $id) {
    $this->rightSalonPermission($salonId);

    // FIND USER
    $employee = $this->employeeRepo->where('id', $id)
    ->where('salon_id', $salonId)->firstOrFail();

    // UPDATE IS BLOCKED STATUS
    $employee->is_active = $request->status;
    // SAVE CHANGES
    $employee->save();
    // RETURN TO VIEW WITH SUCCESS MESSAGE
    $message = __($employee->is_active == 1 ? 'messages.has_been_active' : 'messages.has_been_active');
    return back()->with(['success' => $message]);
  }

  public function rightSalonPermission($id) {
    $user  = auth()->user();
    if(in_array($user->type, ['SALON_OWNER', 'SALON_ADMIN']) && $user->salon_id != $id) {
        abort(403, 'Access denied');
    }
  }

}
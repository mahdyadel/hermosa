<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
use App\Repositories\EmployeeRateRepo;

class EmployeeRateController extends Controller
{
  private $employeeRateRepo;

  public function __construct(EmployeeRateRepo $employeeRateRepo) {
    // INITIATE REPOS
    $this->employeeRateRepo = $employeeRateRepo;
    // AUTH MIDDLEWARE
    $this->middleware('auth');
    // PREMISSIONS MIDDLEWARE
    $this->middleware('permission:CREATE_EMPLOYEES')->only(['create', 'store']);
    $this->middleware('permission:READ_EMPLOYEES')->only('index');
    $this->middleware('permission:UPDATE_EMPLOYEES')->only(['edit', 'update', 'block']);
    $this->middleware('permission:DELETE_EMPLOYEES')->only('destroy');
  }

  public function index(Request $request, $salonId, $employeeId) {
    $employeeRates = $this->employeeRateRepo->filter($salonId, $employeeId, $request->search);
    return view('employee-rate.index', compact('employeeRates'));
  }
  
  public function destroy($salonId, $employeeId, $id) {
    $employeeRate = $this->employeeRateRepo->find($id);
    $employeeRate->delete();

    return redirect("/salons/$salonId/employees/$employeeId/rates")
    ->with(['success' => __('messages.has_been_deleted')]);
  }

}
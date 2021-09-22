<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
use App\Models\PaymentType;

// TRANSFORMERS
use App\Transformers\PaymentTypeTransformer;

class PaymentTypeController extends Controller
{
  protected $paymentTypeRepo;

  public function __construct(PaymentType $paymentTypeRepo) {
    $this->paymentTypeRepo = $paymentTypeRepo;
  }

  public function index(Request $request) {
    $paymentTypes = PaymentType::where('is_active', 1)->get();
    $paymentTypes = fractal($paymentTypes, new PaymentTypeTransformer())->toArray();
    return response()->json($paymentTypes);
  }

}
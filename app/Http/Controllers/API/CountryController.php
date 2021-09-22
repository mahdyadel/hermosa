<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
// use App\Repositories\CountryRepo;
use App\Models\Country;

// TRANSFORMERS
use App\Transformers\CountryTransformer;

class CountryController extends Controller
{
  protected $countryRepo;

  public function __construct(Country $countryRepo) {
    // INITIATE USER REPO
    $this->countryRepo = $countryRepo;
  }

  public function index(Request $request) {
    $countries = Country::where('is_active', 1)->get();
    $countries = fractal($countries, new CountryTransformer())->toArray();
    return response()->json($countries);
  }

}
<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
// use App\Repositories\CountryRepo;
use App\Models\City;

// TRANSFORMERS
use App\Transformers\CityTransformer;

class CityController extends Controller
{
  protected $cityRepo;

  public function __construct(City $cityRepo) {
    // INITIATE USER REPO
    $this->cityRepo = $cityRepo;
  }

  public function index(Request $request, $countryId) {
    $cities = City::where('country_id', $countryId)->where('is_active', 1)->get();
    $cities = fractal($cities, new CityTransformer())->toArray();
    return response()->json($cities);
  }

}
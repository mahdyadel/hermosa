<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;

// REPOSITORIES
// use App\Repositories\CountryRepo;
use App\Models\Salon;
use App\Models\Service;
use App\Models\SalonServiceOffer;

// TRANSFORMERS
use App\Transformers\ServiceTransformer;
use App\Transformers\SalonTransformer;
use App\Transformers\OfferTransformer;
use DB;

class HomeController extends Controller
{
  protected $salonRepo;

  public function __construct(Salon $salonRepo) {
    // INITIATE SALON REPO
    $this->salonRepo = $salonRepo;
  }

  public function index(Request $request) {
    $user        = auth()->user();
    
    $services    = Service::get();
    $salonOffers = Salon::whereHas('offers', function($query){
        $query->whereRaw("DATE_ADD(created_at, INTERVAL hours HOUR) >= NOW()");
    })
    ->with(['offers.salonService', 'workingDays', 'services'])
    ->get();


    $lng = $request->lng;
    $lat = $request->lat;
    $distance = 3;

    $raw = DB::raw(' ( 6371 * acos( cos( radians(' . $lat . ') ) * 
    cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + 
    sin( radians(' . $lat . ') ) *
    sin( radians( lat ) ) ) )  AS distance');

    $nearestSalons = Salon::select('*', $raw)
    ->where('is_active', 1)
    ->where('city_id', $user->city_id)
    ->with(['services' => function($query){
        $query->where('is_active', 1);
    }, 'workingDays'])
    ->addSelect($raw)
    ->orderBy('distance', 'ASC')
    // ->having('distance', '<=', $distance)
    ->get();

    $services      = fractal($services, new ServiceTransformer())->toArray();
    $nearestSalons = fractal($nearestSalons, new SalonTransformer())->toArray();
    $salonOffers   = fractal($salonOffers, new SalonTransformer())->parseIncludes(['offers'])->toArray();

    $response['services']      = $services['data'];
    $response['salonOffers']   = $salonOffers['data'];
    $response['nearestSalons'] = $nearestSalons['data'];

    return response()->json($response);
  }

}
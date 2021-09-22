<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Salon;

class SalonTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    protected $availableIncludes = [
        'offers'
    ];

    public function transform(Salon $salon)
    {
        return [
            'id'           => $salon->id,
            'name'         => $salon->name,
            'main_photo'   => $salon->main_photo ? asset('storage/salons/'.$salon->main_photo) : URL('/').'/images/logo.png',
            'logo'         => $salon->logo ? asset('storage/salons/'.$salon->logo) : URL('/').'/images/logo.png',
            'location'     => [
                'lat' => $salon->lat,
                'lng' => $salon->lng
            ],
            'distance'     => round($salon->distance),
            'rate'         => $salon->rates_sum,
            'rates'        => $salon->rates->map(function($rate){
                return [
                    'id'      => $rate->id,
                    'rate'    => $rate->rate,
                    'comment' => $rate->comment,
                    'user'    => [
                        'id'   => $rate->user->id,
                        'name' => $rate->user->name
                    ]
                ];
            }),
            'services'     => $salon->services->map(function($service) {
                return [
                    'id'                => $service->id,
                    'name'              => $service->name,
                    'minutes'           => $service->minutes,
                    'price'             => $service->price,
                    'has_home_service'  => $service->home_service == 1 ? true : false,
                    'home_service_fees' => $service->home_service_fees
                ];
            }),
            'working_days' => $salon->workingDays->map(function($workingDay){
                return [
                    'id'        => $workingDay->id,
                    'name'      => $workingDay->workingDay->name,
                    'time_from' => $workingDay->time_from,
                    'time_to'   => $workingDay->time_to,
                ];
            })
        ];
    }

    public function includeOffers(Salon $salon)
    {
        $offers = $salon->offers;
        return $this->collection($offers, new OfferTransformer, 'disable');
    }
}

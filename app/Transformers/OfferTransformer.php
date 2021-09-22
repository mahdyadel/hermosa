<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\SalonServiceOffer;

class OfferTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(SalonServiceOffer $salonServiceOffer)
    {
        return [
            'id'           => $salonServiceOffer->id,
            'offer_price'  => $salonServiceOffer->new_price,
            'time_left'    => round((strtotime($salonServiceOffer->created_at. "+$salonServiceOffer->hours hours") - strtotime('now')) / 3600),
            'service'      => [
                'id'                => $salonServiceOffer->salonService->id,
                'name'              => $salonServiceOffer->salonService->name,
                'minutes'           => $salonServiceOffer->salonService->minutes,
                'price'             => $salonServiceOffer->salonService->price,
                'has_home_service'  => $salonServiceOffer->salonService->home_service == 1 ? true : false,
                'home_service_fees' => $salonServiceOffer->salonService->home_service_fees
            ],

        ];
    }
}

<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Country;

class CountryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Country $country)
    {
        return [
            'id'             => $country->id,
            'name'           => $country->name,
            'country_code'   => $country->country_code,
            'mobile_length'  => $country->mobile_length,
            'tax_percentage' => $country->tax_percentage,
            'flag'           => asset('storage/countries/'.$country->flag)  
        ];
    }
}

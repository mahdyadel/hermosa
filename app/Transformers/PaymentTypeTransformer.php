<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\PaymentType;

class PaymentTypeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PaymentType $paymentType)
    {
        return [
            'id'             => $paymentType->id,
            'name'           => $paymentType->name,
            'type'           => $paymentType->type,
            'percentage'     => $paymentType->percentage,
            'support_retail' => $paymentType->support_retail == 1 ? true : false,
        ];
    }
}

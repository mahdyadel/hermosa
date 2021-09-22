<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Service;

class ServiceTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Service $service)
    {
        return [
            'id'     => $service->id,
            'name'   => $service->name,
            'image'  => asset('storage/services/'.$service->image),
            'icon'   => asset('storage/services/'.$service->icon)
        ];
    }
}

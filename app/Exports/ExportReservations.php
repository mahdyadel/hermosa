<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportReservations implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reservation::all();
    }

    public function map($reservation): array
    {
        return [
            $reservation->id,
            $reservation->user->name,
            $reservation->service_type == 'HOME_SERVICE' ? 'Home Service' : 'Salon Service',
            $reservation->paymentType->name,
            $reservation->payment_status,
            $reservation->fixed_price,
            $reservation->discount_amount,
            $reservation->discount_owner,
            $reservation->discounted_price,
            $reservation->tax_amount,
            $reservation->home_service_fees,
            $reservation->final_price,
            $reservation->status,
            @$reservation->promocode->code,
            $reservation->salon_profit_amount,
            $reservation->hermosa_profit_amount,
            $reservation->created_at,
            $reservation->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Client Name',
            'Service Type',
            'Payment Type',
            'Payment Status',
            'Fixed Price',
            'Discount Amount',
            'Discount Owner',
            'Discounted Price',
            'Tax Amount',
            'Home Service Fees',
            'Final Price',
            'Status',
            'Promocode',
            'Salon Profit Amount',
            'Hermosa Profit Amount',
            'Created At',
            'Updated At'
        ];
    }
}

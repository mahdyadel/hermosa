<?php

namespace App\Exports;

use App\Models\Salon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSalons implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Salon::all();
    }

    public function map($salon): array
    {
        return [
            $salon->id,
            $salon->name_ar,
            $salon->name_en,
            $salon->phone,
            $salon->phone_2,
            $salon->bank_name,
            $salon->bank_account_number,
            $salon->bank_name_2,
            $salon->bank_account_number_2,
            $salon->tax_number,
            $salon->commercial_register,
            $salon->is_active == 1 ? 'Active' : 'InActive',
            $salon->percentage,
            @$salon->country->name,
            @$salon->city->name,
            $salon->created_at,
            $salon->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Arabic Name',
            'English Name',
            'Phone',
            'Other Phone',
            'Bank Name',
            'Bank Account Number',
            'Other Bank Name',
            'Other Bank Account Number',
            'Tax Number',
            'Commercial Register',
            'Is Active',
            'Hermosa Percentage',
            'Country',
            'City',
            'Created At',
            'Updated At'
        ];
    }
}

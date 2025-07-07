<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorExport implements FromCollection, WithHeadings
{
    protected $dataPermit;

    // Constructor to receive filtered data
    public function __construct($dataPermit)
    {
        $this->dataPermit = $dataPermit;
    }

    public function collection()
    {
        return $this->dataPermit->map(function ($item) {
            return [
                $item->vendor->permit_number ?? '',
                $item->vendor->company_name ?? '',
                $item->name ?? '',
                $item->id_card ?? '',
               \Carbon\Carbon::parse($item->vendor->validity_date_from)->format('d/m/Y') ?? '',
            \Carbon\Carbon::parse($item->vendor->validity_date_to)->format('d/m/Y') ?? '',
                'Work',
                $item->vendor->work_description ?? '',
                $item->vendor->specific_location ?? '',
                $item->vendor->isolation_name ?? '',
                $item->vendor->number_plate ?? '',
                $item->vendor->status ?? '',
                 \Carbon\Carbon::parse($item->vendor->updated_at)->format('d/m/Y') ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Permit Number', 'Company Name', 'Name', 'ID Card',
            'Validity Date From', 'Validity Date To', 'Type',
            'Work Description', 'Specific Location', 'Isolation Name',
            'Number Plate', 'Status', 'Updated At'
        ];
    }
}

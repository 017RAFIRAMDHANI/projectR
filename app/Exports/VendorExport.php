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
                $item->vendor->validity_date_from ?? '',
                $item->vendor->validity_date_to ?? '',
                'Vendor',
                $item->vendor->work_description ?? '',
                $item->vendor->specific_location ?? '',
                $item->vendor->isolation_name ?? '',
                $item->vendor->number_plate ?? '',
                $item->vendor->status ?? '',
                $item->vendor->updated_at ?? '',
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

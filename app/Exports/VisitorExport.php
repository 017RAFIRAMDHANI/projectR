<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitorExport implements FromCollection, WithHeadings
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
                $item->visitor->permit_number ?? '',
                $item->visitor->company_name ?? '',
                $item->name ?? '',
                $item->id_card ?? '',
             \Carbon\Carbon::parse($item->visitor->request_date_from)->format('d/m/Y') ?? '',
            \Carbon\Carbon::parse($item->visitor->request_date_to)->format('d/m/Y') ?? '',
                $item->visitor->purpose_visit ?? '',

                $item->visitor->purpose_detail ?? '',
                $item->visitor->specific_location ?? '',
                $item->visitor->pic_name ?? '',
                $item->visitor->car_plate_no ?? '',
                $item->visitor->status ?? '',
                  \Carbon\Carbon::parse($item->visitor->updated_at)->format('d/m/Y') ?? '',
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

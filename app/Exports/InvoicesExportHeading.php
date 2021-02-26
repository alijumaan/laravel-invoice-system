<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExportHeading implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Invoice::select('id', 'customer_name', 'customer_email', 'customer_mobile', 'sub_total', 'total_due')
            ->orderBy('customer_name')
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Customer Name',
            'Customer Email',
            'Customer Mobile',
            'Sub total',
            'Total Due'
        ];
    }
}

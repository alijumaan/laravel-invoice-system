<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::select('customer_name', 'customer_email', 'customer_mobile', 'sub_total', 'total_due')
            ->orderBy('customer_name')
            ->get();
    }
}

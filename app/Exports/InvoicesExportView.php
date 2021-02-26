<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExportView implements FromView
{
    public function view(): View
    {
        return view('frontend.table', [
            'invoices' => Invoice::all()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Exports\InvoicesExportHeading;
use App\Exports\InvoicesExportView;
use App\Mail\SendInvoice;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PHPUnit\Exception;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(10);
        return view('frontend.index', compact('invoices'));
    }


    public function create()
    {
        return view('frontend.create');
    }


    public function store(Request $request)
    {
        try {

            $data = request_invoice_data($request);
            $invoice = Invoice::create($data);

            $details_list = request_details_data($request);
            $details = $invoice->details()->createMany($details_list);

            if ($details) {
                return redirect()->route('home')->with([
                    'message' => __('Frontend/frontend.Created_successfully'),
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message' => __('Frontend/frontend.Created_failed'),
                    'alert-type' => 'danger'
                ]);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.Something_was_wrong'),
                'alert-type' => 'danger'
            ]);
        }
    }


    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.show', compact('invoice'));
    }


    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.edit', compact('invoice'));
    }


    public function update(Request $request, $id)
    {
        try {
            $invoice = Invoice::whereId($id)->first();

            $data = request_invoice_data($request);
            $invoice->update($data);

            $invoice->details()->delete();

            $details_list = request_details_data($request);
            $details = $invoice->details()->createMany($details_list);

            if ($details) {
                return redirect()->route('home')->with([
                    'message' => __('Frontend/frontend.Updated_successfully'),
                    'alert-type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'message' => __('Frontend/frontend.Updated_failed'),
                    'alert-type' => 'danger'
                ]);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.Something_was_wrong'),
                'alert-type' => 'danger'
            ]);
        }
    }


    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        if ($invoice) {
            $invoice->delete();
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.Deleted_successfully'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.Deleted_failed'),
                'alert-type' => 'danger'
            ]);
        }
    }


    public function print($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.print', compact('invoice'));
    }


    public function pdf($id)
    {
        $invoice = Invoice::whereId($id)->first();

        $data['invoice_id']         = $invoice->id;
        $data['invoice_date']       = $invoice->invoice_date;
        $data['customer']           = [
            __('Frontend/frontend.Customer_name')       => $invoice->customer_name,
            __('Frontend/frontend.Customer_mobile')     => $invoice->customer_mobile,
            __('Frontend/frontend.Customer_email')      => $invoice->customer_email
        ];
        $items = [];
        $invoice_details            =  $invoice->details()->get();
        foreach ($invoice_details as $item) {
            $items[] = [
                'product_name'      => $item->product_name,
                'unit'              => $item->unitText(),
                'quantity'          => $item->quantity,
                'unit_price'        => $item->unit_price,
                'row_sub_total'     => $item->row_sub_total,
            ];
        }
        $data['items'] = $items;

        $data['invoice_number']     = $invoice->invoice_number;
        $data['created_at']         = $invoice->created_at->format('Y-m-d');
        $data['sub_total']          = $invoice->sub_total;
        $data['discount']           = $invoice->discountResult();
        $data['vat_value']          = $invoice->vat_value;
        $data['shipping']           = $invoice->shipping;
        $data['total_due']          = $invoice->total_due;


        $pdf = PDF::loadView('frontend.pdf', $data);

        if (Route::currentRouteName() == 'invoices.pdf') {
            return $pdf->stream($invoice->invoice_number.'.pdf');
        } else {
            $pdf->save(public_path('assets/invoices/').$invoice->invoice_number.'.pdf');
            return $invoice->invoice_number.'.pdf';
        }

    }


    public function send_to_email($id)
    {
        try {

            $invoice = Invoice::whereId($id)->first();
            $this->pdf($id);

            Mail::to($invoice->customer_email)->locale(config('app.locale'))->send(new SendInvoice($invoice));

            return redirect()->route('home')->with([
                'message' => __('Frontend/frontend.Send_successfully'),
                'alert-type' => 'success'
            ]);

        } catch (Exception $exception) {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.Send_failed'),
                'alert-type' => 'danger'
            ]);
        }
    }

    public function export_all()
    {
        return Excel::download(new InvoicesExport(), 'invoices.xlsx');
    }

    public function export_view()
    {
        return Excel::download(new InvoicesExportView(), 'invoices.xlsx');
    }

    public function export_store()
    {
        Excel::store(new InvoicesExport(), 'invoices-'.now()->toDateString().'.xlsx', 'public');

        return back()->with([
            'message' => __('Frontend/frontend.done'),
            'alert-type' => 'success'
        ]);
    }

    public function export_format($format)
    {
        $extension = strtolower($format);

        if (in_array($format, ['Mpdf', 'Dompdf', 'Tcpdf'])) {
            $extension = 'pdf';
        }

        return Excel::download(new InvoicesExport(), 'invoices.'.$extension, $format);
    }

    public function export_with_heading_row()
    {
        return Excel::download(new InvoicesExportHeading(), 'invoices.xlsx');
    }
}


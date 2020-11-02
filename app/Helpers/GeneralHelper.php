<?php

function request_invoice_data($request)
{
    $data['customer_name'] = $request->customer_name;
    $data['customer_email'] = $request->customer_email;
    $data['customer_mobile'] = $request->customer_mobile;
    $data['company_name'] = $request->company_name;
    $data['invoice_number'] = $request->invoice_number;
    $data['invoice_date'] = $request->invoice_date;
    $data['sub_total'] = $request->sub_total;
    $data['discount_type'] = $request->discount_type;
    $data['discount_value'] = $request->discount_value;
    $data['vat_value'] = $request->vat_value;
    $data['shipping'] = $request->shipping;
    $data['total_due'] = $request->total_due;

    return $data;
}

function request_details_data($request)
{
    $details_list = [];
    for ($i = 0; $i < count($request->product_name); $i++) {
        $details_list[$i]['product_name'] = $request->product_name[$i];
        $details_list[$i]['unit'] = $request->unit[$i];
        $details_list[$i]['quantity'] = $request->quantity[$i];
        $details_list[$i]['unit_price'] = $request->unit_price[$i];
        $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
    }

    return $details_list;
}


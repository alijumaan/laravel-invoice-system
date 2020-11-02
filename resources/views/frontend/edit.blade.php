@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/classic.date.css') }}">
    @if(config('app.locale'))
        <link rel="stylesheet" href="{{ asset('frontend/css/pickadate/rtl.css') }}">
    @endif
    <style>
        form.form label.error, label.error {
            color: red;
            font-style: italic;
        }
    </style>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ __('Frontend/frontend.Invoice', ['invoice_number' => $invoice->invoice_number]) }}</h2>
                    <a href="{{ route('home') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"> </i> {{ __('Frontend/frontend.Back_to_invoices') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoices.update', $invoice->id) }}" method="post" class="form">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_name">{{ __('Frontend/frontend.Customer_name') }}</label>
                                    <input type="text" name="customer_name" value="{{ old('customer_name', $invoice->customer_name) }}" class="form-control" id="customer_name">
                                    @error('customer_name') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_email">{{ __('Frontend/frontend.Customer_email') }}</label>
                                    <input type="email" name="customer_email" value="{{ old('customer_email', $invoice->customer_email) }}" class="form-control" id="customer_email">
                                    @error('customer_email') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_mobile">{{ __('Frontend/frontend.Customer_mobile') }}</label>
                                    <input type="text" name="customer_mobile" value="{{ old('customer_mobile', $invoice->customer_mobile) }}" class="form-control" id="customer_mobile">
                                    @error('customer_mobile') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company_name">{{ __('Frontend/frontend.Company_name') }}</label>
                                    <input type="text" name="company_name" value="{{ old('company_name', $invoice->company_name) }}" class="form-control" id="company_name">
                                    @error('company_name') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_number">{{ __('Frontend/frontend.Invoice_number') }}</label>
                                    <input type="text" name="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}" class="form-control" id="invoice_number">
                                    @error('invoice_number') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_date">{{ __('Frontend/frontend.Invoice_date') }}</label>
                                    <input type="text" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date) }}" class="form-control pickdate" id="invoice_date">
                                    @error('invoice_date') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="invoice_details">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Frontend/frontend.Product_name') }}</th>
                                    <th>{{ __('Frontend/frontend.Unit') }}</th>
                                    <th>{{ __('Frontend/frontend.Quantity') }}</th>
                                    <th>{{ __('Frontend/frontend.Unit_price') }}</th>
                                    <th>{{ __('Frontend/frontend.Subtotal') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoice->details as $item)
                                <tr class="cloning_row" id="{{ $loop->index }}">
                                    <td>
                                        @if($loop->index == 0)
                                            {{ '#' }}
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm delegated-btn">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="product_name[{{ $loop->index }}]" value="{{ old('product_name', $item->product_name) }}" id="product_name" class="form-control product_name">
                                    </td>
                                    <td>
                                        <select name="unit[{{ $loop->index }}]" id="unit" class="form-control unit">
                                            <option></option>
                                            <option value="piece" {{ $item->unit == 'piece' ? 'selected' : '' }}>{{ __('Frontend/frontend.Piece') }}</option>
                                            <option value="g" {{ $item->unit == 'g' ? 'selected' : '' }}>{{ __('Frontend/frontend.Gram') }}</option>
                                            <option value="k" {{ $item->unit == 'k' ? 'selected' : '' }}>{{ __('Frontend/frontend.Kilo_gram') }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[{{ $loop->index }}]" value="{{ old('quantity', $item->quantity) }}" id="quantity" class="form-control quantity">
                                        @error('quantity') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="unit_price[{{ $loop->index }}]" value="{{ old('unit_price', $item->unit_price) }}" id="unit_price" class="form-control unit_price">
                                        @error('unit_price') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="row_sub_total[{{ $loop->index }}]" value="{{ old('row_sub_total', $item->row_sub_total) }}" id="row_sub_total" class="form-control row_sub_total" readonly="readonly">
                                        @error('row_sub_total') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <button type="button" class="btn btn-primary btn_add">{{ __('Frontend/frontend.Add_another_product') }}</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Sub_total') }}</td>
                                    <td>
                                        <input type="number" step="0.01" name="sub_total" value="{{ old('sub_total', $invoice->sub_total) }}" id="sub_total" class="form-control sub_total" readonly="readonly">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Discount') }}</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <select name="discount_type" id="discount_type" class="custom-select discount_type">
                                                <option value="fixed" {{ $invoice->discount_type == 'fixed' ? 'selected' : '' }}>{{ __('Frontend/frontend.SR') }}</option>
                                                <option value="percentage" {{ $invoice->discount_type == 'percentage' ? 'selected' : '' }}>{{ __('Frontend/frontend.Percentage') }}</option>
                                            </select>
                                            <div class="input-group-append">
                                                <input type="number" step="0.01" name="discount_value" value="{{ old('sub_total', $invoice->discount_value) }}" id="discount_value" class="form-control discount_value">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Vat') }} (5%)</td>
                                    <td>
                                        <input type="number" step="0.01" name="vat_value" value="{{ old('sub_total', $invoice->vat_value) }}" id="vat_value" class="form-control vat_value" readonly="readonly">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Shipping') }}</td>
                                    <td>
                                        <input type="number" step="0.01" name="shipping" value="{{ old('sub_total', $invoice->shipping) }}" id="shipping" class="form-control shipping">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Total_due') }}</td>
                                    <td>
                                        <input type="number" step="0.01" name="total_due" value="{{ old('sub_total', $invoice->total_due) }}" id="total_due" class="form-control total_due" readonly="readonly">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">{{ __('Frontend/frontend.Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="{{ asset('frontend/js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('frontend/js/pickadate/picker.js') }}"></script>
    <script src="{{ asset('frontend/js/pickadate/picker.date.js') }}"></script>
    @if(config('app.locale') == 'ar')
        <script src="{{ asset('frontend/js/form_validation/messages_ar.js') }}"></script>
        <script src="{{ asset('frontend/js/pickadate/ar.js') }}"></script>
    @endif
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
@endsection


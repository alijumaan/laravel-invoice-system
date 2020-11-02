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
                <div class="card-header">
                    {{ __('Frontend/frontend.Create_invoice') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_name">{{ __('Frontend/frontend.Customer_name') }}</label>
                                    <input type="text" name="customer_name" class="form-control" id="customer_name">
                                    @error('customer_name') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_email">{{ __('Frontend/frontend.Customer_email') }}</label>
                                    <input type="email" name="customer_email" class="form-control" id="customer_email">
                                    @error('customer_email') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer_mobile">{{ __('Frontend/frontend.Customer_mobile') }}</label>
                                    <input type="text" name="customer_mobile" class="form-control" id="customer_mobile">
                                    @error('customer_mobile') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company_name">{{ __('Frontend/frontend.Company_name') }}</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name">
                                    @error('company_name') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_number">{{ __('Frontend/frontend.Invoice_number') }}</label>
                                    <input type="text" name="invoice_number" class="form-control" id="invoice_number">
                                    @error('invoice_number') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="invoice_date">{{ __('Frontend/frontend.Invoice_date') }}</label>
                                    <input type="text" name="invoice_date" class="form-control pickdate" id="invoice_date">
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
                                <tr class="cloning_row" id="0">
                                    <td>#</td>
                                    <td>
                                        <input type="text" name="product_name[0]" id="product_name" class="form-control product_name">
                                    </td>
                                    <td>
                                        <select name="unit[]" id="unit" class="form-control unit">
                                            <option></option>
                                            <option value="piece">{{ __('Frontend/frontend.Piece') }}</option>
                                            <option value="g">{{ __('Frontend/frontend.Gram') }}</option>
                                            <option value="k">{{ __('Frontend/frontend.Kilo_gram') }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[0]" id="quantity" class="form-control quantity">
                                        @error('quantity') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="unit_price[0]" id="unit_price" class="form-control unit_price">
                                        @error('unit_price') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="row_sub_total[0]" id="row_sub_total" class="form-control row_sub_total" readonly="readonly">
                                        @error('row_sub_total') <span class="help-block text-danger">{{ $message }}</span>@enderror
                                    </td>
                                </tr>
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
                                        <input type="number" step="0.01" name="sub_total" id="sub_total" class="form-control sub_total" readonly="readonly">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Discount') }}</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <select name="discount_type" id="discount_type" class="custom-select discount_type">
                                                <option value="fixed">{{ __('Frontend/frontend.SR') }}</option>
                                                <option value="percentage">{{ __('Frontend/frontend.Percentage') }}</option>
                                            </select>
                                            <div class="input-group-append">
                                                <input type="number" step="0.01" name="discount_value" id="discount_value" class="form-control discount_value" value="0.00">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Vat') }} (5%)</td>
                                    <td>
                                        <input type="number" step="0.01" name="vat_value" id="vat_value" class="form-control vat_value" readonly="readonly">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Shipping') }}</td>
                                    <td>
                                        <input type="number" step="0.01" name="shipping" id="shipping" class="form-control shipping">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">{{ __('Frontend/frontend.Total_due') }}</td>
                                    <td>
                                        <input type="number" step="0.01" name="total_due" id="total_due" class="form-control total_due" readonly="readonly">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">{{ __('Frontend/frontend.Save') }}</button>
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


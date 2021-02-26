@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">

            <div class="mb-3">
                <a href="{{ route('invoices.export') }}" class="btn btn-secondary btm-sm"><i class="fa fa-file-pdf"></i> {{ __('Frontend/frontend.Export_all_customers') }}</a>
                <a href="{{ route('invoices.export_view') }}" class="btn btn-success btm-sm"><i class="fa fa-file-pdf"></i> {{ __('Frontend/frontend.Export_this_table') }}</a>
                <a href="{{ route('invoices.export_store') }}" class="btn btn-primary btm-sm"><i class="fa fa-save"></i> {{ __('Frontend/frontend.Store_as_file') }}</a>
                <a href="{{ route('invoices.export_format', 'Csv') }}" class="btn btn-info btm-sm"><i class="fa fa-save"></i> {{ __('Frontend/frontend.Csv') }}</a>
                <a href="{{ route('invoices.export_format', 'Html') }}" class="btn btn-info btm-sm"><i class="fa fa-save"></i> {{ __('Frontend/frontend.Html') }}</a>
                <a href="{{ route('invoices.export_with_heading_row') }}" class="btn btn-dark btm-sm"><i class="fa fa-file-pdf"></i> {{ __('Frontend/frontend.export_with_heading_row') }}</a>
            </div>

            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ __('Frontend/frontend.Invoices') }}</h2>
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('Frontend/frontend.Add_invoice') }}</a>
                </div>
                    <div class="table-responsive">
                        @include('frontend.table', $invoices)
                    </div>
            </div>

            <div class="float-right mt-3">
                {!! $invoices->links() !!}
            </div>
        </div>
    </div>

@endsection

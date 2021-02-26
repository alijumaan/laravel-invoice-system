@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> {{ __('Frontend/frontend.Add_invoice') }}</a>
            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ __('Frontend/frontend.Invoices') }}</h2>
                    <a href="{{ route('invoices.export') }}" class="btn btn-secondary btm-sm ml-auto"><i class="fa fa-file-pdf"></i> {{ __('Frontend/frontend.Export_all_customers') }}</a>
                    <a href="{{ route('invoices.export_view') }}" class="btn btn-success btm-sm ml-auto"><i class="fa fa-file-pdf"></i> {{ __('Frontend/frontend.Export_this_table') }}</a>
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

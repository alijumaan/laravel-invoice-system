@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ __('Frontend/frontend.Invoices') }}</h2>
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('Frontend/frontend.Add_invoice') }}</a>
                </div>
                    <div class="table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th>{{ __('Frontend/frontend.Customer_name') }}</th>
                                <th>{{ __('Frontend/frontend.Invoice_date') }}</th>
                                <th>{{ __('Frontend/frontend.Total_due') }}</th>
                                <th>{{ __('Frontend/frontend.Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($invoices as $invoice)
                            <tr>
                                <td><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->customer_name }}</a></td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->total_due }}</td>
                                <td>
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" onclick="if (confirm('{{ __('Frontend/frontend.R_u_sure') }}')) { document.getElementById('delete-{{ $invoice->id  }}').submit(); } else { return false; }" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="post" id="delete-{{ $invoice->id  }}" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <td colspan="4" class="text-center">{{ __('Frontend/frontend.No_invoice_found') }}</td>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">
                                    <div class="float-right">
                                        {!! $invoices->links() !!}
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
            </div>
        </div>
    </div>

@endsection

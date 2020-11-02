@extends('layouts.email')

@section('content')

    <h3>{{ __('Emails/emails.Dear_user', ['name' => $invoice->customer_name]) }}</h3>

    <h4>{{ __('Emails/emails.Greetings') }}</h4>

    <p>{!! __('Emails/emails.Find_an_invoice') !!}</p>

@endsection

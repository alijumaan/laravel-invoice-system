@extends('layouts.app')

@section('content')
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="shadow-sm p-4">
                <h3 class="">{{ __('Frontend/frontend.Verify Your Email Address') }}</h3>

                <div class="card-body">


                    {{ __('Frontend/frontend.Before proceeding, please check your email for a verification link.') }}
                    {{ __('Frontend/frontend.If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Frontend/frontend.Click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

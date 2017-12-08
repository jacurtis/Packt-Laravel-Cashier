@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>Manage Subscriptions</h4>
                    {{-- Display the users current subscriptions (or lack thereof) --}}

                    <h5>Subscribe:</h5>
                    <form action="/pay/monthly" method="POST">
                      {{ csrf_field() }}
                      <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}"
                        data-amount="1000"
                        data-name="Cashier Inc."
                        data-description="Monthly Subscription"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-label="Subscribe Monthly"
                        data-panel-label="Subscribe">
                      </script>
                    </form>

                    <form action="/pay/yearly" method="POST" style="margin-top:10px;">
                      {{ csrf_field() }}
                      <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ env('STRIPE_KEY') }}"
                        data-amount="10000"
                        data-name="Cashier Inc."
                        data-description="Yearly Subscription"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-label="Subscribe Annually"
                        data-panel-label="Subscribe">
                      </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if (Auth::user()->subscribed('primary') && Auth::user()->subscription('primary')->onGracePeriod())
            <div class="alert alert-danger">
              You subscription will not renew. You Have canceled, but still have pre-paid time on your subscription.
            </div>
          @endif

          @if (Auth::user()->subscribed('primary') && Auth::user()->subscription('primary')->onTrial())
            <div class="alert alert-info">
              I hope you enjoy your 14 day free trial
            </div>
          @endif
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h4>Manage Subscriptions</h4>

                    @if (Auth::user()->subscribed('primary'))
                      <p class="lead">
                        You are Subscribed!
                      </p>
                      <hr />
                      @if (!Auth::user()->subscription('primary')->onGracePeriod())
                        @if (Auth::user()->subscribedToPlan('yearly', 'primary'))
                          <a href="/pay/monthly" class="btn btn-sm btn-info">Downgrade to Monthly</a>
                        @else
                          <a href="/pay/yearly" class="btn btn-sm btn-primary">Upgrade to Annual</a>
                        @endif
                        <a href="/cancel" class="btn btn-sm btn-danger">Cancel Subscription</a>
                      @endif
                    @else
                      <p class="lead">
                        You are not a subscriber yet!
                      </p>


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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

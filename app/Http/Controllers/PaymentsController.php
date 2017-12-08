<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PaymentsController extends Controller
{
  public function pay(Request $request, $plan)
  {
    $user = Auth::user();
    if ($user->subscribed('primary')) {
      $user->subscription('primary')->swap($plan);
    } else {
      $user->newSubscription('primary', $plan)->trialDays(14)->withCoupon('10off')->create($request->stripeToken);
    }
    return redirect('/home');
  }

  public function cancel()
  {
    Auth::user()->subscription('primary')->cancel();

    return redirect('/home');
  }

  public function invoice(Request $request, $invoiceId)
  {
    return $request->user()->downloadInvoice($invoiceId, [
      'vendor' => 'Cashier Inc.',
      'product' => 'Primary Subscription'
    ]);
  }
}

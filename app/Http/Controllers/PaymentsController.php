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
      $user->newSubscription('primary', $plan)->create($request->stripeToken);
    }
    return redirect('/home');
  }

  public function cancel()
  {
    Auth::user()->subscription('primary')->cancel();

    return redirect('/home');
  }
}

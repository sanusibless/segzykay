<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {
    
    $data = Paystack::getAuthorizationUrl([
                'amount' => $request->votes * 200 * 100,
                'email' => $request->email,
                'user' => $request->user,
                'reference' => Str::random(15),
                'userId' => $request->user,
            ])->redirectNow();
    return $data;
    }

    public function handleCallback()
    {
        dd(Paystack::getPaymentData());
    }
}

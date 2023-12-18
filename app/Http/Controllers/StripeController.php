<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StripeController extends Controller
{
    //
    public function payment(Request $request){
        // dd($request->all());
    
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
    
        $response = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'USD',
                    'product_data' => [
                        'name' => 'Absa Card Test',
                    ],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);
    
        // dd($response);

        return redirect()->away($response->url);
    }
    

    public function success(Request $request){

    }

    public function cancel(Request $request){

    }
}

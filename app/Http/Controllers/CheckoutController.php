<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Response;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('checkout');
    }

    public function paymentItents()
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $intent = PaymentIntent::create([
                'amount' => 2099,
                'currency' => env("STRIPE_CURRENCY"),
            ]);
            ob_start();
            echo("New Order: " . $intent->id);
            error_log(ob_get_clean(), 4);
            return response()->json($intent);
        } catch (Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}

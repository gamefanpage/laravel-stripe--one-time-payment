<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Exception\SignatureVerificationException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function webhooks(Request $request, Response $response)
    {
        // You can find your endpoint's secret in your webhook settings
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');
        $payload = $request->getContent();
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            return response()->json(['message' => 'fail'], 400);
        } catch (SignatureVerificationException $e) {
            return response()->json(['message' => 'fail'], 403);
        }

        ob_start();
        if ($event->type == "payment_intent.succeeded") {
            $intent = $event->data->object;
            echo("Paid Order: " . $intent->id);
        } elseif ($event->type == "payment_intent.payment_failed") {
            $intent = $event->data->object;
            $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : "";
            echo("Failed Order: " . $intent->id);
        }
        error_log(ob_get_clean(), 4);

        return response()->json(['message' => 'success']);
    }
}

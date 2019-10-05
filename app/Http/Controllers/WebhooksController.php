<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use UnexpectedValueException;

class WebhooksController extends Controller
{

    /**
     * Handle the incoming Stripe webhook.
     *
     * @return Response
     */
    public function handle(Request $request)
    {
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

        $method = $this->eventToMethod($event->type);

        ob_start();
        if (method_exists($this, $method)) {
            $this->$method($event);
        }
        error_log(ob_get_clean(), 4);

        return response()->json(['message' => 'Webhook Received']);
    }

    public function eventToMethod($event)
    {
        return 'when' . Str::studly(str_replace('.', '_', $event));
    }

    public function whenPaymentItentSucceeded($event)
    {
        $intent = $event->data->object;
        echo("Paid Order: " . $intent->id);
    }

    public function whenPaymentItentFailed($event)
    {
        $intent = $event->data->object;
        $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : "";
        echo("Failed Order: " . $intent->id);
    }
}

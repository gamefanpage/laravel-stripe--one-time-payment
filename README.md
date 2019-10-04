# laravel-stripe--one-time-payment
From One-Time Payments (SCA) Live walkthrough of Payment Intents, one-time payments, and automatic confirmation workflows.

## Getting setup...

1. Copy `.env.example` to `.env`

2. Set `STRIPE_SECRET_KEY` and `STRIPE_PUBLISHABLE_KEY` in `.env`.

3. [Download Composer](https://getcomposer.org) into this project's directory.

4. From this project's directory, run `php composer.phar install` to install dependencies.

5. Run `php artisan key:generate`

6. Start the development web server with `php artisan serve`

7. Navigate to <http://localhost:8000/checkout>

## Alternative
Getting up Valet for able to use stripe webhook :

[Laravel Valet](https://laravel.com/docs/6.x/valet)

1. Mac user : <https://github.com/laravel/valet>
2. Windows user : <https://github.com/cretueusebiu/valet-windows>

Valet installed :
- > valet link
- > valet secure
- > valet share 

It will return :  the site has been secured with a fresh TLS certificate.
You will need the https://xxxxxx.ngrok.io for the stripe webhook

## Creating payments takes five steps:
 
1. [Create a PaymentIntent on the server](https://stripe.com/docs/payments/payment-intents/web#creating)
2. [Pass the PaymentIntent’s client secret to the client](https://stripe.com/docs/payments/payment-intents/web#passing-to-client)
3. [Collect payment method details on the client](https://stripe.com/docs/payments/payment-intents/web#elements)
4. [Submit the payment to Stripe from the client](https://stripe.com/docs/payments/payment-intents/web#completing-payment)
5. [Asynchronously fulfill the customer’s order](https://stripe.com/docs/payments/payment-intents/web#fulfillment)

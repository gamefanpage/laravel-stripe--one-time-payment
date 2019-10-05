@extends('layouts.app')

@section('extra-style')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
@endsection

@section('nav')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="https://stripe-samples.github.io/developer-office-hours/logo.svg"
                 alt="" width="72"
                 height="72">
            <h1>Auto Confirm Shop - Checkout form</h1>
            <p class="lead">Below is an example form built entirely with Bootstrap’s form controls.</p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product name</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$8.99</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20.99</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing information</h4>
                <form class="needs-validation" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="cardholder-name">Name on card</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="cardholder-name" value="Jenny Rosen" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Name on card is required
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <hr class="mb-4">
                    <button id="card-button" class="btn btn-primary btn-lg btn-block" type="submit">
                        Submit Payment $20.99
                    </button>
                    <hr class="mb-4">
                    <div class="mb-3" id="card-message"></div>
                </form>
            </div>
        </div>
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>

@endsection

@section('extra-js')
    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ config('services.stripe.key') }}');

        // Pass the PaymentIntent’s client secret to the client
        var paymentIntent;
        fetch('/payment_intents').then(function (r) {
            return r.json();
        }).then(function (response) {
            paymentIntent = response;
            console.log("Fetched PI: ", response);
        });

        // Collect payment method details on the client
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Submit the payment to Stripe from the client
        var cardholderName = document.getElementById('cardholder-name');
        var cardButton = document.getElementById('card-button');
        var cardMessage = document.getElementById('card-message');  // for testing (to remove)

        // var clientSecret = cardButton.dataset.secret;
        cardButton.addEventListener('click', function (ev) {
            ev.preventDefault();
            cardMessage.textContent = "Calling handleCardPayment..."; // for testing (to remove)
            stripe.handleCardPayment(
                paymentIntent.client_secret, cardElement, {
                    payment_method_data: {
                        billing_details: {name: cardholderName.value}
                    }
                }
            ).then(function (result) {
                cardMessage.textContent = JSON.stringify(result, null, 2); // for testing (to remove)
                // if (result.error) {
                //     // Display error.message in your UI.
                //     // Inform the user if there was an error
                //     var errorElement = document.getElementById('card-errors');
                //     errorElement.textContent = result.error.message;
                // } else {
                //     // Send the token to your server
                // }
            });
        });
    </script>
@endsection

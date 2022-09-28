<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.

    'sandbox' => [

        'client_id'         => 'AdI5iFI5RP_2kGIBA5UnvKcrKEnRe5gNoVFloo0A-hmzyq92EQJbVykUitNL0qTj5meUS3yC6ieGvhQg',

        'client_secret'     => 'ECGKFwa8CelQ56A2oiIgKK23Z4joibpH-fGfgV2QXTAXBwClmkzCQYrahdoBiwTC5g7r6wV7cGjdOXZv',

        'app_id'            => 'APP-80W284485P519543T',

    ],


    'live' => [

        'client_id'         => 'AWpGJCkbGubTlvytlsThVv-YMAdN-fMqqrIRKcGIbzD5QpAqHFK-Zl6qwBgIA_jZD0evIOMsweXvOeqv',

        'client_secret'     => 'ECAhBP-DBUWRGDA479q5fZ9aGeG5k5C5Sydy1UInhpLSbe53Hx9i2w_eNYKwrIY-9VeUZQYpzKw0J40w',

        'app_id'            => 'APP-80W284485P519543T',

    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];

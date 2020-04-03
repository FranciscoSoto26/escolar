<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '410737672328-5b9nfqjgeqk09c20u29tvnp5f17acdp4.apps.googleusercontent.com',
        'client_secret' => 'VRgV081k4SYD6KHXr8P3L56A',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],
    'chatapi' => [
        'token'          => env('CHATAPI_TOKEN', ''),
        'api_url'       => env('CHATAPI_URL', ''),
    ],

];

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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'konferensi_service' => [
        'url' => env('KONFERENSI_SERVICE_URL_SAMUD', 'http://192.168.100.65/projek-services/gateway-service/'),
        'key' => env('GATEWAY_KEY_KONFERNESI_SAMUD', 'CON123'),
    ],

    'tiketSamud_service' => [
        'url' => env('KONFERENSI_SERVICE_URL_SAMUD','http://192.168.100.65/projek-services/gateway-service/'),
        'key' => env('GATEWAY_KEY_TIKET_SAMUD','TIK123'),
    ],

    'musikal_service' => [
        'url' => env('MUSIKAL_SERVICE_URL_NITA','http://192.168.100.70/musikal/api-gateway/'),
        'key' => env('GATEWAY_KEY_MUSIKAL_NITA','musikal123'),
    ],

    'tiketNita_service' => [
        'url' => env('TIKET_SERVICE_URL_NITA','http://192.168.100.70/musikal/api-gateway/'),
        'key' => env('GATEWAY_KEY_TIKET_NITA','TIK123'),
    ],
];
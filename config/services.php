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

    /*
     *  Api doc: https://www.voicerss.org/api/
     * */
    'voice_rss' => [
        'key' => env('VOICE_RSS_KEY'),
        'v' => env('VOICE_RSS_V', 'Linda'),
        'hl' => env('VOICE_RSS_HL', 'en-us'),
        'r' => env('VOICE_RSS_R', '0'), // -10 to 10
        'c' => env('VOICE_RSS_C', 'mp3'), // mp3, wav, ogg
        'b64' => env('VOICE_RSS_B64', false),
    ],
];

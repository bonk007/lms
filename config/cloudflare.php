<?php

return [
    'base_url' => 'https://api.cloudflare.com/client',
//    'base_url' => 'https://customer-vfw6arr5ungnr1ac.cloudflarestream.com',
    'api_version' => 'v4',
    'account_id' => env('CLOUDFLARE_ACCOUNT_ID'),
    'token' => env('CLOUDFLARE_TOKEN'),
    'api_key' => env('CLOUDFLARE_GLOBAL_KEY')
];

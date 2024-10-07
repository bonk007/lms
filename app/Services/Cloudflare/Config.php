<?php

namespace App\Services\Cloudflare;

class Config
{
    public const BASE_URL = 'https://api.cloudflare.com/client';

    public const API_VERSION = 'v4';

    public function __construct(protected string $accountId, protected string $token)
    {
    }

    public function token(): string
    {
        return $this->token;
    }

    public function getBaseUrl(): string
    {
        return static::BASE_URL
            . '/accounts' . $this->accountId
            . '/' . static::API_VERSION;
    }
}

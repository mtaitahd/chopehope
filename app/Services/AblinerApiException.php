<?php

namespace App\Services;

use RuntimeException;

class AblinerApiException extends RuntimeException
{
    public function __construct(
        string $message,
        public readonly string $providerCode,
        public readonly bool $definitiveRejection,
    ) {
        parent::__construct($message);
    }
}

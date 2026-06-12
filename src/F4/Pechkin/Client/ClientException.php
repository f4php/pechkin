<?php

declare(strict_types=1);

namespace F4\Pechkin\Client;

use Exception;
use Throwable;
use F4\Pechkin\DataType\ResponseParameters;

class ClientException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        public readonly ?ResponseParameters $parameters = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}

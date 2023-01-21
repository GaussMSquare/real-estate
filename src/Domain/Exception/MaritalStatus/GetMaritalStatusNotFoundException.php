<?php

namespace App\Domain\Exception\MaritalStatus;

class GetMaritalStatusNotFoundException extends \RuntimeException
{
    private const GET_MARITAL_STATUS_NOT_FOUND_CODE = 300;
    private const GET_MARITAL_STATUS_NOT_FOUND_MESSAGE = 'Cannot get marital statuses';

    public function __construct(string $message = self::GET_MARITAL_STATUS_NOT_FOUND_MESSAGE, int $code = self::GET_MARITAL_STATUS_NOT_FOUND_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
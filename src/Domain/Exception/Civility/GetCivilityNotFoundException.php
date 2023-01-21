<?php

namespace App\Domain\Exception\Civility;

class GetCivilityNotFoundException extends \RuntimeException
{
    private const GET_CIVILITY_NOT_FOUND_CODE = 200;
    private const GET_CIVILITY_NOT_FOUND_MESSAGE = 'Cannot get civilities';

    public function __construct(string $message = self::GET_CIVILITY_NOT_FOUND_MESSAGE, int $code = self::GET_CIVILITY_NOT_FOUND_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
<?php

namespace App\Domain\Exception\Country;

class GetCountryNotFoundException extends \RuntimeException
{
    private const GET_COUNTRY_NOT_FOUND_CODE = 100;
    private const GET_COUNTRY_NOT_FOUND_MESSAGE = 'Cannot get countries';

    public function __construct(string $message = self::GET_COUNTRY_NOT_FOUND_MESSAGE, int $code = self::GET_COUNTRY_NOT_FOUND_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
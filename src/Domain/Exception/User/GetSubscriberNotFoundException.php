<?php

namespace App\Domain\Exception\User;

final class GetSubscriberNotFoundException extends \RuntimeException
{
    private const GET_SUBSCRIBER_NOT_FOUND_CODE = 400;
    private const GET_SUBSCRIBER_NOT_FOUND_MESSAGE = 'Cannot get subscriber(s)';

    public function __construct(string $message = self::GET_SUBSCRIBER_NOT_FOUND_MESSAGE, int $code = self::GET_SUBSCRIBER_NOT_FOUND_CODE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
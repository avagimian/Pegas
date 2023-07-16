<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

abstract class BusinessLogicException extends Exception
{
    const VALIDATION_FAILED = 600;
    const SAVING_ERROR = 601;
    CONST USER_NOT_FOUND = 602;

    private int $httpStatusCode = Response::HTTP_BAD_REQUEST;

    abstract public function getStatus(): int;

    abstract public function getStatusMessage(): string;

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}

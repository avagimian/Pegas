<?php

namespace App\Exceptions;

use Exception;

class FailImportFailedException extends Exception
{
    protected $code = 600;

    public function __construct($message = null, $code = null, Exception $previous = null)
    {
        if (!$message) {
            $message = __('error.fail_import_failed');
        }

        parent::__construct($message, $code, $previous);
    }
}
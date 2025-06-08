<?php

namespace App\Orbit\core\Exceptions;

use Exception;

class NullPointerException extends Exception
{
    public function __construct(string $message)
    {
        return parent::__construct("NullPointerException: {$message}");
    }
}

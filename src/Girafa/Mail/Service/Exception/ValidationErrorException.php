<?php

namespace Girafa\Mail\Service\Exception;

use InvalidArgumentException;
use Girafa\Mail\Exception\ExceptionInterface;

/**
 * This exception is thrown if the API returned validation errors
 */
class ValidationErrorException extends InvalidArgumentException implements ExceptionInterface
{
}

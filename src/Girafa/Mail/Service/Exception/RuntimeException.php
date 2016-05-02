<?php

namespace Girafa\Mail\Service\Exception;

use RuntimeException as BaseRuntimeException;
use Girafa\Mail\Exception\ExceptionInterface;

/**
 * This exception is thrown for exceptions that cannot be classified
 */
class RuntimeException extends BaseRuntimeException implements ExceptionInterface
{
}

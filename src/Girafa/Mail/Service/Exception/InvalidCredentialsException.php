<?php

namespace Girafa\Mail\Service\Exception;

use RuntimeException as BaseRuntimeException;
use Girafa\Mail\Exception\ExceptionInterface;

/**
 * This exception is thrown whenever the API returns that credentials are wrong
 */
class InvalidCredentialsException extends BaseRuntimeException implements ExceptionInterface
{
}

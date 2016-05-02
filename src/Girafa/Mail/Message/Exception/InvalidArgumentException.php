<?php

namespace Girafa\Mail\Mail\Message\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;
use Girafa\Mail\Exception\ExceptionInterface;

class InvalidArgumentException extends BaseInvalidArgumentException implements ExceptionInterface
{
}

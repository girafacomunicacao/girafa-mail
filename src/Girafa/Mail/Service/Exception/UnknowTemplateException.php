<?php

namespace Girafa\Mail\Service\Exception;

use RuntimeException as BaseRuntimeException;
use Girafa\Mail\Exception\ExceptionInterface;

/**
 * This exception is thrown for when a template is not known (only for services that support it)
 */
class UnknownTemplateException extends BaseRuntimeException implements ExceptionInterface
{
}

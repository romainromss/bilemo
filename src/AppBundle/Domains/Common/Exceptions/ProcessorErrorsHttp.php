<?php


namespace AppBundle\Domains\Common\Exceptions;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProcessorErrorsHttp
 */
class ProcessorErrorsHttp
{
    public static function throwAccessDenied(string $message)
    {
        throw new AccessDeniedHttpException(
            $message
        );
    }
    public static function throwNotFound(string $message)
    {
        throw new NotFoundHttpException(
            $message
        );
    }
}

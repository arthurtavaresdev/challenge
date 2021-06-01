<?php

namespace App\Exceptions;

use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

class HttpException extends RuntimeException implements HttpExceptionInterface
{
    protected int $statusCode;
    protected $message;
    private array $headers;

    public function __construct(int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, string $message = '', ?Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->message = $message ?? trans("http.{$statusCode}");
        $this->headers = $headers;

        parent::__construct($this->message, $code, $previous);
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}

<?php


namespace response;


class BadResponse implements ResponseInterface
{
    /** @var int  */
    protected $statusCode;
    /** @var string */
    protected $errorMessage;

    /** @var array */
    protected $headers;

    /**
     * BadResponse constructor.
     * @param $headers
     */
    public function __construct($headers = [])
    {
        $this->headers = $headers;
    }

    /**
     * @param string $header
     */
    public function sendHeader(string $header)
    {
        header($header);
    }


    public function sendHeaders()
    {
        if (!empty($this->headers)) {
            foreach ($this->headers as $header) {
                header($header);
            }
        }
        return;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }


    public function send(): void
    {
        $this->sendHeaders();
        http_response_code($this->statusCode);
        die($this->errorMessage);
    }
}

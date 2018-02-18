<?php


namespace response;


class SuccessResponse implements ResponseInterface
{

    /** @var int */
    protected $statusCode;
    /** @var string */
    protected $content;

    /** @var array */
    protected $headers;

    /**
     * SuccessResponse constructor.
     * @param $headers
     * @param $content
     */
    public function __construct(array $headers = [], string $content)
    {
        $this->headers = $headers;
        $this->content = $content;
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
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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


    public function send():void
    {
        $this->sendHeaders();
        http_response_code($this->statusCode);
        echo $this->content;
    }
}

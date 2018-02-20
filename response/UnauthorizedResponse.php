<?php


namespace response;


class UnauthorizedResponse implements ResponseInterface
{

    /** @var int */
    protected $statusCode = 401;
    /** @var string */
    protected $content;

    /** @var array */
    protected $headers;

    /**
     * SuccessResponse constructor.
     * @param $headers
     * @param $content
     */
    public function __construct(string $content, array $headers = array())
    {
        $this->headers = $headers;
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
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
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        array_merge($this->headers, [$headers]);
    }

    public function addHeaders()
    {
        if (!empty($this->headers)) {
            foreach ($this->headers as $header) {
                header($header);
            }
        }
        return;
    }
}
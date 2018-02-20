<?php


namespace response;


class NotFoundResponse implements ResponseInterface
{
    /** @var int */
    protected $statusCode = 404;
    /** @var string */
    protected $content;

    /** @var array */
    protected $headers;

    /**
     * NotFoundResponse constructor.
     * @param array $headers
     * @param string $content
     */
    public function __construct(string $content, array $headers = [])
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
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        array_merge($this->headers, [$headers]);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
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

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}

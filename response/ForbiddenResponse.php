<?php


namespace response;


class ForbiddenResponse implements ResponseInterface
{

    /** @var string */
    protected $content;
    /** @var array */
    protected $headers;

    /**
     * @return array|null
     */
    public function getHeaders(): ?array
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
        return self::FORBIDDEN_STATUS_CODE;
    }

    /**
     * @param string $header
     */
    public function addHeader(string $header)
    {
        $this->headers[] = $header;
    }
}
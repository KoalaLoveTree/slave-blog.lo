<?php


namespace response;


class RedirectResponse implements ResponseInterface
{

    /** @var array */
    protected $headers;
    /** @var string */
    protected $content;

    /**
     * @param string $header
     */
    public function addHeader(string $header)
    {
        $this->headers[] = $header;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return self::FOUND_STATUS_CODE;
    }

    /**
     * @return array|null
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }
}
<?php

namespace response;

interface ResponseInterface
{
    public function addHeaders();

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers);

    /**
     * @return array
     */
    public function getHeaders(): array ;

    /**
     * @param string $content
     */
    public function setContent(string $content);

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return int
     */
    public function getStatusCode(): int;

}


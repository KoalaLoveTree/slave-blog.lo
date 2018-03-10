<?php

namespace response;

interface ResponseInterface
{

    const SUCCESS_STATUS_CODE = 200;
    const NOT_FOUND_STATUS_CODE = 404;
    const FORBIDDEN_STATUS_CODE = 403;
    const UNAUTHORIZED_STATUS_CODE = 401;
    const FOUND_STATUS_CODE = 302;

    /**
     * @param string $header
     */
    public function addHeader(string $header): void;

    /**
     * @param string $content
     */
    public function setContent(string $content): void;

    /**
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @return array
     */
    public function getHeaders(): ?array;
}


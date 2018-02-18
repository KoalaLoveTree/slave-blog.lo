<?php

namespace response;

interface ResponseInterface
{

    public function sendHeaders();

    /**
     * @param string $header
     */
    public function sendHeader(string $header);

    public function send(): void;
}

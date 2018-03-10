<?php

namespace application;

use response\ResponseInterface;
use route\Router;
use route\StandardParser;

class ApplicationMediator implements MediatorInterface
{

    /**
     * @param string $url
     */
    public function run(string $url): void
    {
        $response = $this->makeRequest($url);
        $this->sendResponse($response);
    }

    /**
     * @param ResponseInterface $response
     */
    public function sendResponse(ResponseInterface $response): void
    {
        http_response_code($response->getStatusCode());
        if (!empty($response->getHeaders())) {
            foreach ($response->getHeaders() as $header) {
                header($header);
            }
        }
        echo $response->getContent();
    }

    /**
     * @param string $request
     * @return ResponseInterface
     */
    public function makeRequest(string $request): ResponseInterface
    {
        $router = new Router();
        return $router->callAction(StandardParser::parseUrl($request));
    }
}

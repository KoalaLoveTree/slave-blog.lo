<?php

namespace application;

use response\ResponseInterface;
use route\Router;
use route\StandardParser;

class ApplicationMediator implements MediatorInterface
{

    public function run(string $url)
    {
        $response = $this->makeRequest($url);
        $this->sendResponse($response);
    }

    /**
     * @param ResponseInterface $response
     */
    public function sendResponse(ResponseInterface $response)
    {
        $response->send();
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

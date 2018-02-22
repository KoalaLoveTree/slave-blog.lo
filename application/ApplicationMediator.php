<?php

namespace application;

use core\helper\ErrorsCheckHelper;
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

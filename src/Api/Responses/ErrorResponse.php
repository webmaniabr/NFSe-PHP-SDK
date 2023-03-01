<?php

namespace Webmaniabr\Nfse\Api\Responses;

use GuzzleHttp\Psr7\Response;
use Webmaniabr\Nfse\Interfaces\APIResponse;

class ErrorResponse implements APIResponse
{
    private Response $Response;
    private string $content = '';

    public function __construct(Response $response, string $content)
    {
        $this->Response = $response;
        $this->content = $content;
    }

    /**
     * {@inheritDoc}
     */
    public function getSuccess(): bool
    {
        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        if ($json = json_decode($this->content)) {
            if (isset($json->error)) {
                return $json->error;
            }
            if (isset($json->msg)) {
                return $json->msg;
            }
        }
        return '';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getObjectResponse(): Response
    {
        return $this->Response;
    }
}
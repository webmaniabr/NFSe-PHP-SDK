<?php

namespace Webmaniabr\Nfse\Api\Responses;

use GuzzleHttp\Psr7\Response;
use Webmaniabr\Nfse\Interfaces\APIResponse;

class SuccessResponse implements APIResponse
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
        return true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function getObjectResponse(): Response
    {
        return $this->Response;
    }

    /**
     * Retorna o objeto JSON retornado na requisição.
     * @return object
     */
    public function getResponse()
    {
        return json_decode($this->content);
    }
}
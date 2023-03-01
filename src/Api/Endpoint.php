<?php

namespace Webmaniabr\Nfse\Api;

class Endpoint
{
    private string $url;
    private string $method;
    private array $headers = [];

    public function __construct(string $url, string $method, array $headers)
    {
        $this->url = $url;
        $this->method = $method;
        $this->headers = $headers;
    }

    /**
     * Retorna a URL do endpoint.
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * Retorna o método HTTP da requisição.
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Retorna os cabeçalhos para a requisição.
     * @return array
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }
}
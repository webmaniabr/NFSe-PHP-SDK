<?php

namespace Webmaniabr\Nfse\Interfaces;

use Webmaniabr\Nfse\Api\Endpoint;

interface APIConnection
{
    /**
     * Retorna a URL da API.
     * @return string
     */
    public function getDomain() : string;
    
    /**
     * Retorna o token de autenticação na API.
     * @return string
     */
    public function getBearerToken() : string;

    /**
     * Retorna as informações de proxy.
     * @return array
     */
    public function getProxy() : array;
}
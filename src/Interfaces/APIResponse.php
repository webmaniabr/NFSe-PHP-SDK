<?php

namespace Webmaniabr\Nfse\Interfaces;

use GuzzleHttp\Psr7\Response;

interface APIResponse
{
    /**
     * Retorna o sucesso da requisição.
     * @return bool
     */
    public function getSuccess() : bool;

    /**
     * Retorna a mensagem de retorno.
     * @return string|object
     */
    public function getMessage();

    /**
     * Retorna a Response original.
     * @return Response
     */
    public function getObjectResponse() : Response;
}
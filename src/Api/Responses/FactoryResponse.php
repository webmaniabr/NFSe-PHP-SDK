<?php

namespace Webmaniabr\Nfse\Api\Responses;

use GuzzleHttp\Psr7\Response;
use Webmaniabr\Nfse\Interfaces\APIResponse;

abstract class FactoryResponse
{
    private static Response $response;
    private static string $content = '';

    /**
     * Retorna uma instância de resposta da API.
     */
    public static function getResponseInstance(Response $response) : APIResponse
    {
        self::$response = $response;
        self::$content = $response->getBody()->getContents();
        if (self::isErrorResponse()) {
            return new ErrorResponse(self::$response, self::$content);
        }
        return new SuccessResponse(self::$response, self::$content);
    }

    /**
     * Identifica se ocorreu erro na requisição.
     * @return bool
     */
    private static function isErrorResponse() : bool
    {
        $json = json_decode(self::$content);
        if (self::$response->getStatusCode() != 200 || ( $json && isset($json->error) )) {
            return true;
        }
        return false;
    }
}
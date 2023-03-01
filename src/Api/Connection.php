<?php

namespace Webmaniabr\Nfse\Api;

use Webmaniabr\Nfse\Interfaces\APIConnection;

class Connection implements APIConnection
{
    /**
     * Bearer token de autenticação na API.
     * @var string
     */
    private string $bearerToken = '';

    /**
     * Informações de comunicação com proxy.
     * @see https://docs.guzzlephp.org/en/stable/request-options.html#proxy
     * @var array
     */
    private array $proxy = [];

    private static Connection $instance;

    private function __construct() { }

    /**
     * @return $this
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Define o token de autenticação.
     * @param string $token
     */
    public function setBearerToken(string $token)
    {
        $this->bearerToken = $token;
    }

    /**
     * Retorna o token de autenticação.
     * @return string
     */
    public function getBearerToken() : string
    {
        return $this->bearerToken;
    }

    /**
     * Define as informações do proxy.
     * @param array $proxy
     */
    public function setProxy(array $proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * {@inheritDoc}
     */
    public function getDomain() : string
    {
        return 'https://api.webmaniabr.com';
    }

    /**
     * {@inheritDoc}
     */
    public function getProxy() : array
    {
        return $this->proxy;
    }
}
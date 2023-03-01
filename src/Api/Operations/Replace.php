<?php

namespace Webmaniabr\Nfse\Api\Operations;

use Webmaniabr\Nfse\Api\Connection;
use Webmaniabr\Nfse\Api\Endpoint;
use Webmaniabr\Nfse\Api\Http\Client;
use Webmaniabr\Nfse\Interfaces\APIResponse;

class Replace extends Issue
{
    private int $motivo;
    private string $codigoVerificacao = '';

    /**
     * Define o motivo da substituição.
     * @param int $motivo
     */
    public function setMotivo(int $motivo)
    {
        $this->motivo = $motivo;
    }

    /**
     * Define o código da NFS-e que será substituída.
     * @param string $codigoVerificacao
     */
    public function setCodigoVerificacao(string $codigoVerificacao)
    {
        $this->codigoVerificacao = $codigoVerificacao;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndpoint() : Endpoint
    {
        return new Endpoint('/2/nfse/substituir', 'POST', [ 'Authorization'   => 'Bearer '. Connection::getInstance()->getBearerToken(),
                                                            'Content-Type'    => 'application/json' ]);
    }

    /**
     * {@inheritDoc}
     */
    public function execute() : APIResponse
    {
        $this->makeJSON();
        $this->toSend->codigo_verificacao = $this->codigoVerificacao;
        $this->toSend->motivo = $this->motivo;
        return (new Client())->send($this);
    }
}
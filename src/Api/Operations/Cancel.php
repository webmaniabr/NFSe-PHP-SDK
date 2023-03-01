<?php

namespace Webmaniabr\Nfse\Api\Operations;

use Webmaniabr\Nfse\Api\Connection;
use Webmaniabr\Nfse\Api\Endpoint;
use Webmaniabr\Nfse\Api\Http\Client;
use Webmaniabr\Nfse\Interfaces\APIOperation;
use Webmaniabr\Nfse\Interfaces\APIResponse;
use Webmaniabr\Nfse\Models\NFSe;

class Cancel implements APIOperation
{
    private NFSe $NFSe;
    private int $motivo;

    /**
     * Define a NFS-e que será consultada.
     * @param NFSe $NFSe
     */
    public function setNFSe(NFSe $NFSe)
    {
        $this->NFSe = $NFSe;
    }

    /**
     * Define o motivo do cancelamento do documento.
     * @param int $motivo
     */
    public function setMotivo(int $motivo)
    {
        $this->motivo = $motivo;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndpoint() : Endpoint
    {
        return new Endpoint('/2/nfse/cancelar', 'PUT', [ 'Authorization'   => 'Bearer '. Connection::getInstance()->getBearerToken(),
                                                         'Content-Type'    => 'application/json' ]);
    }

    /**
     * {@inheritDoc}
     */
    public function execute() : APIResponse
    {
        return (new Client())->send($this);
    }

    /**
     * {@inheritDoc}
     */
    public function getContentToSend()
    {
        return json_encode((object) [ 'uuid'   => $this->NFSe->uuid,
                                      'motivo' => $this->motivo ]);
    }
}
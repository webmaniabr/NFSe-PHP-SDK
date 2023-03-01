<?php

namespace Webmaniabr\Nfse\Api\Operations;

use Webmaniabr\Nfse\Api\Connection;
use Webmaniabr\Nfse\Api\Endpoint;
use Webmaniabr\Nfse\Api\Http\Client;
use Webmaniabr\Nfse\Interfaces\APIOperation;
use Webmaniabr\Nfse\Interfaces\APIResponse;
use Webmaniabr\Nfse\Models\NFSe;

class Consult implements APIOperation
{
    private NFSe $NFSe;

    /**
     * Define a NFS-e que será consultada.
     * @param NFSe $NFSe
     */
    public function setNFSe(NFSe $NFSe)
    {
        $this->NFSe = $NFSe;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndpoint() : Endpoint
    {
        return new Endpoint("/2/nfse/consulta/{$this->NFSe->uuid}", 'GET', [ 'Authorization'   => 'Bearer '. Connection::getInstance()->getBearerToken(),
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
        return '';
    }
}
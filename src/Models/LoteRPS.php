<?php

namespace Webmaniabr\Nfse\Models;

use DateTime;
use Webmaniabr\Nfse\Api\Operations\Issue;
use Webmaniabr\Nfse\Interfaces\APIResponse;
use Webmaniabr\Nfse\Interfaces\DocumentForIssuance;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#lote_rps_nfse
 */
class LoteRPS implements DocumentForIssuance
{
    /**
     * URL de notificação do status da NFS-e.
     * @var string
     * @see https://webmaniabr.com/docs/rest-api-nfse/#notificacoes
     */
    public string $urlNotificacao;

    /**
     * Permite especificar a Data e Hora para agendar a emissão da Nota Fiscal.
     * @var DateTime
     * @see https://webmaniabr.com/docs/rest-api-nfse/#informacoes-nota-fiscal
     */
    public DateTime $agendamento;

    /**
     * Lista dos documentos para emissão.
     * @var RPS[]
     */
    private array $aRPS = [];

    /**
     * {@inheritDoc}
     */
    public function getUrlNotificacao() : string
    {
        return $this->urlNotificacao;
    }

    /**
     * {@inheritDoc}
     */
    public function getAgendamento() : DateTime
    {
        return $this->agendamento;
    }

    /**
     * {@inheritDoc}
     */
    public function getDocuments(): array
    {
        return $this->aRPS;
    }

    /**
     * Cria e retorna uma nova instância de RPS.
     * @return RPS
     */
    public function newRPS()
    {
        $rps = new RPS();
        $this->aRPS[] = $rps;
        return $rps;
    }

    /**
     * Adiciona um novo RPS à lista.
     * @param RPS $RPS
     */
    public function addRPS(RPS $RPS)
    {
        $this->aRPS[] = $RPS;
    }

    /**
     * Retorna a alista de RPS.
     * @return RPS[]
     */
    public function getListaRPS()
    {
        return $this->aRPS;
    }

    /**
     * {@inheritDoc}
     */
    public function emitir() : APIResponse
    {
        $issueOperation = new Issue();
        $issueOperation->setDocumentForIssuance($this);
        return $issueOperation->execute();
    }
    
    /**
     * {@inheritDoc}
     */
    public function emitirHomologacao() : APIResponse
    {
        $issueOperation = new Issue();
        $issueOperation->setProductionEnviroment(false);
        $issueOperation->setDocumentForIssuance($this);
        return $issueOperation->execute();
    }
}
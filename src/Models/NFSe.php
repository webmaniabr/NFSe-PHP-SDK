<?php

namespace Webmaniabr\Nfse\Models;

use DateTime;
use Webmaniabr\Nfse\Api\Operations\Cancel;
use Webmaniabr\Nfse\Api\Operations\Consult;
use Webmaniabr\Nfse\Api\Operations\Issue;
use Webmaniabr\Nfse\Api\Operations\Replace;
use Webmaniabr\Nfse\Interfaces\APIResponse;
use Webmaniabr\Nfse\Interfaces\DocumentForIssuance;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#informacoes-nota-fiscal
 */
class NFSe extends DocumentoFiscal implements DocumentForIssuance
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
     * Identificador único da NFS-e. Para consulta e Cancelamento.
     * @var string
     */
    public string $uuid = '';

    /**
     * {@inheritDoc}
     */
    public function getDocuments(): array
    {
        return [ $this ];
    }

    /**
     * {@inheritDoc}
     */
    public function getUrlNotificacao()
    {
        if (isset($this->urlNotificacao)){
            return $this->urlNotificacao;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAgendamento()
    {
        if (isset($this->agendamento)) {
            return $this->agendamento;
        }
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
        $issueOperation->setDocumentForIssuance($this);
        $issueOperation->setProductionEnviroment(false);
        return $issueOperation->execute();
    }

    /**
     * Consulta a NFS-e.
     * @return APIResponse
     */
    public function consultar() : APIResponse
    {
        $consultOperation = new Consult();
        $consultOperation->setNFSe($this);
        return $consultOperation->execute();
    }

    /**
     * Cancela a NFS-e
     * @param int $motivo
     * @return APIResponse
     */
    public function cancelar(int $motivo) : APIResponse
    {
        $cancelOperation = new Cancel();
        $cancelOperation->setNFSe($this);
        $cancelOperation->setMotivo($motivo);
        return $cancelOperation->execute();
    }

    /**
     * Substitui uma NFS-e por outra.
     * @param string $codigoVerificacao
     * @param int $motivo
     * @return APIResponse
     */
    public function substituir(string $codigoVerificacao, int $motivo) : APIResponse
    {
        $replaceOperation = new Replace();
        $replaceOperation->setDocumentForIssuance($this);
        $replaceOperation->setCodigoVerificacao($codigoVerificacao);
        $replaceOperation->setMotivo($motivo);
        return $replaceOperation->execute();
    }
    
    /**
     * Substitui uma NFS-e por outra em ambiente de homologação.
     * @param string $codigoVerificacao
     * @param int $motivo
     * @return APIResponse
     */
    public function substituirHomologacao(string $codigoVerificacao, int $motivo) : APIResponse
    {
        $replaceOperation = new Replace();
        $replaceOperation->setDocumentForIssuance($this);
        $replaceOperation->setCodigoVerificacao($codigoVerificacao);
        $replaceOperation->setMotivo($motivo);
        $replaceOperation->setProductionEnviroment(false);
        return $replaceOperation->execute();
    }
}
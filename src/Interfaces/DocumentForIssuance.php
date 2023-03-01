<?php

namespace Webmaniabr\Nfse\Interfaces;

use DateTime;
use Webmaniabr\Nfse\Models\DocumentoFiscal;

interface DocumentForIssuance
{
    /**
     * Retorna a URL de notificação.
     * @return string|null
     */
    public function getUrlNotificacao();

    /**
     * Retorna a data/hora para agendamento de emissão.
     * @return DateTime|null
     */
    public function getAgendamento();

    /**
     * Lista dos documentos para emissão.
     * @return DocumentoFiscal[]
     */
    public function getDocuments() : array;

    /**
     * Emite o documento em ambiente de Produção.
     * @return APIResponse
     */
    public function emitir() : APIResponse;

    /**
     * Emite o documento em ambiente de Homologação.
     * @return APIResponse
     */
    public function emitirHomologacao() : APIResponse;
}
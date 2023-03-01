<?php

namespace Webmaniabr\Nfse\Traits\Providers\Florianopolis;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-florianopolis
 */
trait Servico
{
    /**
     * Código Fiscal de Prestação de Serviços.
     * @provider Florianópolis
     * @var string
     */
    public string $cfps;

    /**
     * Código Identificador do Serviço Prestado.
     * @provider Florianópolis
     * @var string
     */
    public string $idCnae;

    /**
     * Código da Situação Tributária.
     * @provider Florianópolis
     * @var string
     */
    public string $situacaoTributaria;
}
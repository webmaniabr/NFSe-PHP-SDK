<?php

namespace Webmaniabr\Nfse\Traits\Providers\IPM;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-ipm
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider IPM
     * @var string
     */
    public string $codigoServico;

    /**
     * Código de Situação Tributária.
     * @provider IPM
     * @var string
     */
    public string $situacaoTributaria;
}
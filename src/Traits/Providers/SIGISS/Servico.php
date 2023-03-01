<?php

namespace Webmaniabr\Nfse\Traits\Providers\SIGISS;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-sigiss
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider SIGISS
     * @var string
     */
    public string $codigoServico;

    /**
     * Tipo de tributação.
     * @provider SIGISS
     * @var int
     */
    public int $tributacao;
}
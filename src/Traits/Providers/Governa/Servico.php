<?php

namespace Webmaniabr\Nfse\Traits\Providers\Governa;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-governa
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider Governa
     * @var string
     */
    public string $codigoServico;

    /**
     * Código do Regime de Recolhimento.
     * @provider Governa
     * @var string
     */
    public string $regimeRecolhimento;

    /**
     * Código da Forma de Recolhimento.
     * @provider Governa
     * @var string
     */
    public string $formaRecolhimento;
}
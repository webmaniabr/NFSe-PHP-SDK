<?php

namespace Webmaniabr\Nfse\Traits\Providers\Equiplano;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-equiplano
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider Equiplano
     * @var string
     */
    public string $codigoServico;
    
    /**
     * Justificativa do valor das deduções.
     * @provider Equiplano
     * @var string
     */
    public string $justificativaDeducoes;
}
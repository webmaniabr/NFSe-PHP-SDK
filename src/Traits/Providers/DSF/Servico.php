<?php

namespace Webmaniabr\Nfse\Traits\Providers\DSF;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-dsf
 */
trait Servico
{
    /**
     * Código de identificação da atividade.
     * @provider DSF
     * @var string
     */
    public string $codigoCnae;
    
    /**
     * Tipo da Operação.
     * @provider DSF
     * @var string
     */
    public string $tipoOperacao;
    
    /**
     * Tipo de Tributação.
     * @provider DSF
     * @var string
     */
    public string $tipoTributacao;
}
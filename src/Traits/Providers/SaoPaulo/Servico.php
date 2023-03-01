<?php

namespace Webmaniabr\Nfse\Traits\Providers\SaoPaulo;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-saopaulo
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider São Paulo
     * @var string
     */
    public string $codigoServico;

    /**
     * Valor percentual da carga tributária.
     * @provider São Paulo
     * @var float
     */
    public float $cargaTributaria;

    /**
     * Fonte de informação da carga tributária.
     * @provider São Paulo
     * @var string
     */
    public string $fonteCargaTributaria;
}
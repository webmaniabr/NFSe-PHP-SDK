<?php

namespace Webmaniabr\Nfse\Traits\Providers\Publica;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#publica_deducoes
 */
trait NotaDeducao
{
    /**
     * Número do documento à deduzir.
     * @provider Pública
     * @var string
     */
    public string $numero;

    /**
     * Valor do documento à deduzir.
     * @provider Pública
     * @var float
     */
    public float $valor;

    /**
     * Chave de validação do document o à deduzir.
     * @provider Pública
     * @var string
     */
    public string $chave;
}
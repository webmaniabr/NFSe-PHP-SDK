<?php

namespace Webmaniabr\Nfse\Traits\Providers\Publica;

use DateTime;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#publica_parcelas
 */
trait Parcela
{
    /**
     * Condição de pagamento.
     * @provider Pública
     * @var string
     */
    public string $condicao;

    /**
     * Valor da parcela.
     * @provider Pública
     * @var float
     */
    public float $valor;

    /**
     * Data de vencimento da parcela.
     * @provider Pública
     * @var DateTime
     */
    public DateTime $dataVencimento;
}
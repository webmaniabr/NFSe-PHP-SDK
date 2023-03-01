<?php

namespace Webmaniabr\Nfse\Models;

use Webmaniabr\Nfse\Interfaces\OptionalObjectParameter;
use Webmaniabr\Nfse\Traits\Providers;

/**
 * Impostos da NFS-e.
 * @see https://webmaniabr.com/docs/rest-api-nfse/#impostos-nfse
 */
class Impostos implements OptionalObjectParameter
{
    use Providers\Equiplano\Impostos;

    /**
     * Alíquota do ISS.
     * @var float
     */
    public float $iss;

    /**
     * Alíquota do PIS.
     * @var float
     */
    public float $pis;
    
    /**
     * Alíquota do COFINS.
     * @var float
     */
    public float $cofins;
    
    /**
     * Alíquota do INSS.
     * @var float
     */
    public float $inss;

    /**
     * Alíquota do IR.
     * @var float
     */
    public float $ir;

    /**
     * Alíquota do CSLL.
     * @var float
     */
    public float $csll;

    /**
     * {@inheritDoc}
     */
    public function hasRequiredValues() : bool
    {
        return isset($this->iss) || isset($this->pis) || isset($this->cofins) || isset($this->inss) || isset($this->ir) || isset($this->csll) || isset($this->descricaoImpostos);
    }
}
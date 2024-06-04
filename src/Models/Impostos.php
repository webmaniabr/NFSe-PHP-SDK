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
     * @var string
     */
    public string $iss;

    /**
     * Alíquota do PIS.
     * @var string
     */
    public string $pis;
    
    /**
     * Alíquota do COFINS.
     * @var string
     */
    public string $cofins;
    
    /**
     * Alíquota do INSS.
     * @var string
     */
    public string $inss;

    /**
     * Alíquota do IR.
     * @var string
     */
    public string $ir;

    /**
     * Alíquota do CSLL.
     * @var string
     */
    public string $csll;

    /**
     * {@inheritDoc}
     */
    public function hasRequiredValues() : bool
    {
        return isset($this->iss) || isset($this->pis) || isset($this->cofins) || isset($this->inss) || isset($this->ir) || isset($this->csll) || isset($this->descricaoImpostos);
    }
}
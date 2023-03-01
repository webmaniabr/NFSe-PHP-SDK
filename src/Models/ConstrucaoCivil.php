<?php

namespace Webmaniabr\Nfse\Models;

use Webmaniabr\Nfse\Interfaces\OptionalObjectParameter;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#informacoes-construcao-civil
 */
class ConstrucaoCivil implements OptionalObjectParameter
{
    /**
     * Código da Obra.
     * @var string
     */
    public string $codigoObra;

    /**
     * Código da Anotação de Responsabilidade Técnica.
     * @var string
     */
    public string $art;

    /**
     * {@inheritDoc}
     */
    public function hasRequiredValues() : bool
    {
        return isset($this->codigoObra) || isset($this->art);
    }
}
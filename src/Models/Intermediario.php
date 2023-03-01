<?php

namespace Webmaniabr\Nfse\Models;

use Webmaniabr\Nfse\Interfaces\OptionalObjectParameter;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#informacoes-intermediario
 */
class Intermediario implements OptionalObjectParameter
{
    /**
     * CPF do intermediário, quando for Pessoa Física.
     * @var string
     */
    public string $cpf;

    /**
     * Nome completo do intermediário, quando for Pessoa Física.
     * @var string
     */
    public string $nomeCompleto;

    /**
     * CNPJ do intermediário, quando for Pessoa Jurídica.
     * @var string
     */
    public string $cnpj;

    /**
     * Razão social do intermediário, quando for Pessoa Jurídica.
     * @var string
     */
    public string $razaoSocial;

    /**
     * Inscrição municipal do intermediário.
     * @var string
     */
    public string $inscricaoMunicipal;

    /**
     * Define se o Intermediário é o responsável pelo ISS retido.
     * @var bool
     */
    public bool $responsavelIss;

    /**
     * {@inheritDoc}
     */
    public function hasRequiredValues() : bool
    {
        return isset($this->cpf) || isset($this->nomeCompleto) || isset($this->cnpj) || isset($this->razaoSocial);
    }
}
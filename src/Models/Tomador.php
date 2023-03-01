<?php

namespace Webmaniabr\Nfse\Models;

use Webmaniabr\Nfse\Interfaces\OptionalObjectParameter;
use Webmaniabr\Nfse\Traits\Providers;

class Tomador implements OptionalObjectParameter
{
    use Providers\Equiplano\Tomador;

    /**
     * CPF, quando pessoa Física.
     * @var string
     */
    public string $cpf;

    /**
     * Nome completo, quando pessoa Física.
     * @var string
     */
    public string $nomeCompleto;
    
    /**
     * CNPJ, quando pessoa Jurídica.
     * @var string
     */
    public string $cnpj;
    
    /**
     * Razão Social, quando pessoa Jurídica.
     * @var string
     */
    public string $razaoSocial;
    
    /**
     * Inscrição municipal.
     * @var string
     */
    public string $inscricaoMunicipal;
    
    /**
     * Código de identificação fiscal.
     * @var string
     */
    public string $identificacaoFiscal;
    
    /**
     * Descrição do endereço.
     * @var string
     */
    public string $endereco;
    
    /**
     * Número da residência.
     * @var string
     */
    public string $numero;
    
    /**
     * Complemento do endereço.
     * @var string
     */
    public string $complemento;
    
    /**
     * Bairro de residência.
     * @var string
     */
    public string $bairro;
    
    /**
     * Cidade de residência.
     * @var string
     */
    public string $cidade;
    
    /**
     * Unidade federal da cidade de residência.
     * @var string
     */
    public string $uf;
    
    /**
     * CEP de residência.
     * @var string
     */
    public string $cep;
    
    /**
     * E-mail de contato.
     * @var string
     */
    public string $email;
    
    /**
     * Telefone de contato.
     * @var string
     */
    public string $telefone;

    /**
     * {@inheritDoc}
     */
    public function hasRequiredValues() : bool
    {
        return isset($this->cpf) || isset($this->nomeCompleto) || isset($this->cnpj) || isset($this->razaoSocial) || isset($this->documentoEstrangeiro);
    }
}
<?php

namespace Webmaniabr\Nfse\Traits\Providers\Abrasf;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-abrasf
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider Abrasf
     * @var string
     */
    public string $codigoServico;
    
    /**
     * Código de identificação da atividade.
     * @provider Abrasf
     * @var string
     */
    public string $codigoCnae;
    
    /**
     * Código de Tributação no município.
     * @provider Abrasf
     * @var string
     */
    public string $codigoTributacaoMunicipio;
    
    /**
     * Código da natureza de operação.
     * @provider Abrasf
     * @var string
     */
    public string $naturezaOperacao;
    
    /**
     * Exigibilidade do ISS.
     * @provider Abrasf
     * @var int
     */
    public int $exigibilidadeIss;
    
    /**
     * Código da Nomenclatura Brasileira de Serviços.
     * @provider Abrasf
     * @var string
     */
    public string $codigoNbs;
}
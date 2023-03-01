<?php

namespace Webmaniabr\Nfse\Models;

use Webmaniabr\Nfse\Traits\Providers;

/**
 * Serviço Prestado.
 * @see https://webmaniabr.com/docs/rest-api-nfse/#informacoes-servico
 */
class Servico
{
    use Providers\Abrasf\Servico,
        Providers\Cecam\Servico,
        Providers\DSF\Servico,
        Providers\Equiplano\Servico,
        Providers\Florianopolis\Servico,
        Providers\Governa\Servico,
        Providers\IPM\Servico,
        Providers\Osasco\Servico,
        Providers\Publica\Servico,
        Providers\SaoPaulo\Servico,
        Providers\SIGISS\Servico;

    /**
     * Descrição do serviço prestado.
     * @var string
     */
    public string $discriminacao;

    /**
     * Valor do serviço prestado.
     * @var float
     */
    public float $valorServico;

    /**
     * Referência da classe de imposto cadastrada.
     * @var string
     * @see https://webmaniabr.com/docs/rest-api-nfse/#impostos-nfse
     */
    public string $classeImposto;
    
    /**
     * Modelo das alíquotas de impostos.
     * @var Impostos
     * @see https://webmaniabr.com/docs/rest-api-nfse/#impostos-nfse
     */
    public Impostos $Impostos;

    /**
     * Define se o ISS é retido na fonte.
     * @var bool
     */
    public bool $issRetido;

    /**
     * Valor das deduções.
     * @var float
     */
    public float $deducoes;

    /**
     * Valor do desconto incondicionado.
     * @var float 
     */
    public float $descontoIncondicionado;

    /**
     * Valor do desconto condicionado.
     * @var float 
     */
    public float $descontoCondicionado;

    /**
     * Valor de outras retenções.
     * @var float
     */
    public float $outrasRetencoes;

    /**
     * Número do processo judicial/administrativo.
     * @var string
     */
    public string $numeroProcesso;

    /**
     * Modelo do Intermediário do serviço.
     * @var Intermediario
     */
    public Intermediario $Intermediario;

    /**
     * Inicialização dos modelos.
     */
    public function __construct()
    {
        $this->Impostos = new Impostos();
        $this->Intermediario = new Intermediario();
    }
}
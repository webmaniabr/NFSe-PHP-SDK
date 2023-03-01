<?php

namespace Webmaniabr\Nfse\Traits\Providers\Cecam;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-cecam
 */
trait Servico
{
    /**
     * Código de identificação da atividade.
     * @provider Cecam
     * @var string
     */
    public string $codigoCnae;
    
    /**
     * Código de identificação do serviço prestado.
     * @provider Cecam
     * @var string
     */
    public string $codigoServico;
    
    /**
     * Local de prestação do serviço.
     * @provider Cecam
     * @var string
     */
    public string $localPrestacao;
    
    /**
     * CEP do local de prestação.
     * @provider Cecam
     * @var string
     */
    public string $cepLocalPrestacao;
}
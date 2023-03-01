<?php

namespace Webmaniabr\Nfse\Traits\Providers\Osasco;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-osasco
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider Osasco
     * @var string
     */
    public string $codigoServico;

    /**
     * Endereço do local de prestação do serviço.
     * @provider Osasco
     * @var string
     */
    public string $enderecoLocalPrestacao;

    /**
     * CEP do local de prestação do serviço.
     * @provider Osasco
     * @var string
     */
    public string $cepLocalPrestacao;

    /**
     * Cidade do local de prestação do serviço.
     * @provider Osasco
     * @var string
     */
    public string $cidadeLocalPrestacao;

    /**
     * Unidade Federal do local de prestação do serviço.
     * @provider Osasco
     * @var string
     */
    public string $ufLocalPrestacao;
}
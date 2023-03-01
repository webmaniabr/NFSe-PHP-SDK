<?php

namespace Webmaniabr\Nfse\Traits\Providers\Equiplano;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-equiplano
 */
trait Tomador
{
    /**
     * Inscrição Estadual do tomador.
     * @provider Equiplano
     * @var string
     */
    public string $inscricaoEstadual;

    /**
     * Identificação do documento para Tomador Estrangeiro.
     * @provider Equiplano
     * @var string
     */
    public string $documentoEstrangeiro;

    /**
     * Nome da cidade do Tomador Estrangeiro.
     * @provider Equiplano
     * @var string
     */
    public string $cidadeEstrangeira;

    /**
     * Nome do País de residência.
     * @provider Equiplano
     * @var string
     */
    public string $pais;
}
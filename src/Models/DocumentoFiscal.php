<?php

namespace Webmaniabr\Nfse\Models;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#lote_rps_nfse
 */
abstract class DocumentoFiscal
{
    /**
     * Serviço prestado.
     * @var Servico
     */
    public Servico $Servico;

    /**
     * Tomador do serviço.
     * @var Tomador
     */
    public Tomador $Tomador;

    /**
     * Informações de Obra vinculada ao serviço.
     * @var ConstrucaoCivil
     */
    public ConstrucaoCivil $ConstrucaoCivil;

    /**
     * Inicialização dos modelos.
     */
    public function __construct()
    {
        $this->Servico         = new Servico();
        $this->Tomador         = new Tomador();
        $this->ConstrucaoCivil = new ConstrucaoCivil();
    }
}
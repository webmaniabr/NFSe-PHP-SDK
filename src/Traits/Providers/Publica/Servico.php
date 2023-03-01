<?php

namespace Webmaniabr\Nfse\Traits\Providers\Publica;
use Webmaniabr\Nfse\Models\NotaDeducao;
use Webmaniabr\Nfse\Models\Parcela;

/**
 * @see https://webmaniabr.com/docs/rest-api-nfse/#provedores-publica
 */
trait Servico
{
    /**
     * Código de identificação do serviço prestado.
     * @provider Pública
     * @var string
     */
    public string $codigoServico;

    /**
     * Código da natureza de operação.
     * @provider Pública
     * @var string
     */
    public string $naturezaOperacao;

    /**
     * Notas para dedução do ISS Contrução Civil.
     * @provider Pública
     * @var NotaDeducao[]
     */
    public array $notasDeducao = [];

    /**
     * Parcelas de pagamento.
     * @provider Pública
     * @var Parcela[]
     */
    public array $parcelas = [];

    /**
     * Cria e retorna uma nova Nota de Dedução.
     * @provider Pública
     * @return NotaDeducao
     */
    public function newNotaDeducao()
    {
        $notaDeducao = new NotaDeducao();
        $this->notasDeducao[] = $notaDeducao;
        return $notaDeducao;
    }

    /**
     * Cria e retorna uma nova parcela de pagamento.
     * @provider Pública
     * @return Parcela
     */
    public function newParcela()
    {
        $parcela = new Parcela();
        $this->parcelas[] = $parcela;
        return $parcela;
    }
}
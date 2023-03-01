<?php

namespace Webmaniabr\Nfse\Api\Operations;

use stdClass;
use Webmaniabr\Nfse\Api\Connection;
use Webmaniabr\Nfse\Api\Endpoint;
use Webmaniabr\Nfse\Api\Http\Client;
use Webmaniabr\Nfse\Interfaces\APIOperation;
use Webmaniabr\Nfse\Interfaces\APIResponse;
use Webmaniabr\Nfse\Interfaces\DocumentForIssuance;
use Webmaniabr\Nfse\Models\ConstrucaoCivil;
use Webmaniabr\Nfse\Models\DocumentoFiscal;
use Webmaniabr\Nfse\Models\Impostos;
use Webmaniabr\Nfse\Models\Intermediario;
use Webmaniabr\Nfse\Models\Servico;
use Webmaniabr\Nfse\Models\Tomador;

class Issue implements APIOperation
{
    protected stdClass $toSend;
    protected DocumentForIssuance $ForIssuance;
    protected bool $productionEnviroment = true;

    /**
     * Define o Documento que será emitido.
     * @param DocumentForIssuance $Document
     */
    public function setDocumentForIssuance(DocumentForIssuance $Document)
    {
        $this->ForIssuance = $Document;
    }

    /**
     * Define se será utilizado o ambiente de produção.
     * @param bool $prodEnviroment
     */
    public function setProductionEnviroment(bool $prodEnviroment)
    {
        $this->productionEnviroment = $prodEnviroment;
    }

    /**
     * {@inheritDoc}
     */
    public function getContentToSend()
    {
        return json_encode($this->toSend);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getEndpoint() : Endpoint
    {
        return new Endpoint('/2/nfse/emissao', 'POST', [ 'Authorization' => 'Bearer '. Connection::getInstance()->getBearerToken(),
                                                         'Content-Type'  => 'application/json' ]);
    }
    
    /**
     * {@inheritDoc}
     */
    public function execute() : APIResponse
    {
        $this->makeJSON();
        return (new Client())->send($this);
    }

    /**
     * Cria o JSON de emissão.
     */
    protected function makeJSON()
    {
        $this->toSend = new stdClass();
        $this->toSend->ambiente = $this->productionEnviroment ? 1 : 2;
        if (!is_null($this->ForIssuance->getUrlNotificacao())) {
            $this->toSend->url_notificacao = $this->ForIssuance->getUrlNotificacao();
        }
        if (!is_null($this->ForIssuance->getAgendamento())) {
            $this->toSend->agendar = $this->ForIssuance->getAgendamento()->format('Y-m-d H:m:s');
        }
        $this->toSend->rps = [];
        foreach ($this->ForIssuance->getDocuments() as $Document) {
            $this->convertDocumentToJSON($Document);
        }
    }

    /**
     * Cria o JSON do RPS.
     * @param DocumentoFiscal $Document
     */
    private function convertDocumentToJSON(DocumentoFiscal $Document)
    {
        $rps = new stdClass();
        $this->convertServicoToJSON($rps, $Document->Servico);
        if ($Document->Tomador->hasRequiredValues()) {
            $this->convertTomadorToJSON($rps, $Document->Tomador);
        }
        if ($Document->ConstrucaoCivil->hasRequiredValues()) {
            $this->convertConstrucaoCivilToJSON($rps, $Document->ConstrucaoCivil);
        }
        $this->toSend->rps[] = $rps;
    }

    /**
     * Cria o JSON do serviço.
     * @param stdClass $rps
     * @param Servico $Servico
     */    
    private function convertServicoToJSON(stdClass $rps, Servico $Servico) 
    {
        $rps->servico = new stdClass();
        $rps->servico->discriminacao = $Servico->discriminacao;
        $rps->servico->valor_servicos = $Servico->valorServico;
        if (isset($Servico->classeImposto)) {
            $rps->servico->classe_imposto = $Servico->classeImposto;
        }
        if ($Servico->Impostos->hasRequiredValues()) {
            $this->convertImpostosServicoToJSON($rps->servico, $Servico->Impostos);
        }
        if (isset($Servico->issRetido) && $Servico->issRetido) {
            $rps->servico->iss_retido = 1;
            if ($Servico->Intermediario->hasRequiredValues()) {
                $rps->servico->responsavel_retencao_iss = isset($Servico->Intermediario->responsavelIss) && $Servico->Intermediario->responsavelIss ? 2 : 1;
            }
        } else {
            $rps->servico->iss_retido = 2;
        }
        if (isset($Servico->deducoes)) {
            $rps->servico->deducoes = $Servico->deducoes;
        }
        if (isset($Servico->descontoIncondicionado)) {
            $rps->servico->desconto_incondicionado = $Servico->descontoIncondicionado;
        }
        if (isset($Servico->descontoCondicionado)) {
            $rps->servico->desconto_condicionado = $Servico->descontoCondicionado;
        }
        if (isset($Servico->outrasRetencoes)) {
            $rps->servico->outras_retencoes = $Servico->outrasRetencoes;
        }
        if (isset($Servico->numeroProcesso)) {
            $rps->servico->numero_processo = $Servico->numeroProcesso;
        }
        if ($Servico->Intermediario->hasRequiredValues()) {
            $this->convertIntermediarioServicoToJSON($rps->servico, $Servico->Intermediario);
        }
        if (isset($Servico->codigoServico)) {
            $rps->servico->codigo_servico = $Servico->codigoServico;
        }
        if (isset($Servico->codigoCnae)) {
            $rps->servico->codigo_cnae = $Servico->codigoCnae;
        }
        if (isset($Servico->codigoTributacaoMunicipio)) {
            $rps->servico->codigo_tributacao_municipio = $Servico->codigoTributacaoMunicipio;
        }
        if (isset($Servico->naturezaOperacao)) {
            $rps->servico->natureza_operacao = $Servico->naturezaOperacao;
        }
        if (isset($Servico->exigibilidadeIss)) {
            $rps->servico->exigibilidade_iss = $Servico->exigibilidadeIss;
        }
        if (isset($Servico->numeroProcesso)) {
            $rps->servico->numero_processo = $Servico->numeroProcesso;
        }
        if (isset($Servico->codigoNbs)) {
            $rps->servico->codigo_nbs = $Servico->codigoNbs;
        }
        if (isset($Servico->localPrestacao)) {
            $rps->servico->local_prestacao = $Servico->localPrestacao;
        }
        if (isset($Servico->cepLocalPrestacao)) {
            $rps->servico->cep_local_prestacao = $Servico->cepLocalPrestacao;
        }
        if (isset($Servico->tipoOperacao)) {
            $rps->servico->tipo_operacao = $Servico->tipoOperacao;
        }
        if (isset($Servico->tipoTributacao)) {
            $rps->servico->tipo_tributacao = $Servico->tipoTributacao;
        }
        if (isset($Servico->justificativaDeducoes)) {
            $rps->servico->justificativa_deducoes = $Servico->justificativaDeducoes;
        }
        if (isset($Servico->cfps)) {
            $rps->servico->cfps = $Servico->cfps;
        }
        if (isset($Servico->idCnae)) {
            $rps->servico->id_cnae = $Servico->idCnae;
        }
        if (isset($Servico->situacaoTributaria)) {
            $rps->servico->situacao_tributaria = $Servico->situacaoTributaria;
        }
        if (isset($Servico->regimeRecolhimento)) {
            $rps->servico->regime_recolhimento = $Servico->regimeRecolhimento;
        }
        if (isset($Servico->formaRecolhimento)) {
            $rps->servico->forma_recolhimento = $Servico->formaRecolhimento;
        }
        if (isset($Servico->enderecoLocalPrestacao)) {
            $rps->servico->endereco_localPrestacao = $Servico->enderecoLocalPrestacao;
        }
        if (isset($Servico->cepLocalPrestacao)) {
            $rps->servico->cep_local_prestacao = $Servico->cepLocalPrestacao;
        }
        if (isset($Servico->cidadeLocalPrestacao)) {
            $rps->servico->cidade_local_prestacao = $Servico->cidadeLocalPrestacao;
        }
        if (isset($Servico->ufLocalPrestacao)) {
            $rps->servico->uf_local_prestacao = $Servico->ufLocalPrestacao;
        }
        if (sizeof($Servico->notasDeducao) > 0) {
            $rps->servico->notas_deducao = [];
            foreach ($Servico->notasDeducao as $notaDeducao) {
                $rps->servico->notas_deducao[] = (object) [ 'numero' => $notaDeducao->numero,
                                                            'valor'  => $notaDeducao->valor,
                                                            'chave'  => $notaDeducao->chave ];
            }
        }
        if (sizeof($Servico->parcelas) > 0) {
            $rps->servico->parcelas = [];
            foreach ($Servico->parcelas as $parcela) {
                $rps->servico->parcelas[] = (object) [ 'condicao'        => $parcela->condicao,
                                                       'valor'           => $parcela->valor,
                                                       'data_vencimento' => $parcela->dataVencimento->format('Y-m-d') ];
            }
        }
        if (isset($Servico->cargaTributaria)) {
            $rps->servico->carga_tributaria = $Servico->cargaTributaria;
        }
        if (isset($Servico->fonteCargaTributaria)) {
            $rps->servico->fonte_carga_tributaria = $Servico->fonteCargaTributaria;
        }
        if (isset($Servico->tributacao)) {
            $rps->servico->tributacao = $Servico->tributacao;
        }
    }

    /**
     * Cria o JSON dos impostos.
     * @param stdClass $servico
     * @param Impostos $Impostos
     */
    private function convertImpostosServicoToJSON(stdClass $servico, Impostos $Impostos)
    {
        $servico->impostos = new stdClass();
        if (isset($Impostos->iss)) {
            $servico->impostos->iss = $Impostos->iss;
        }
        if (isset($Impostos->pis)) {
            $servico->impostos->pis = $Impostos->pis;
        }
        if (isset($Impostos->cofins)) {
            $servico->impostos->cofins = $Impostos->cofins;
        }
        if (isset($Impostos->inss)) {
            $servico->impostos->inss = $Impostos->inss;
        }
        if (isset($Impostos->ir)) {
            $servico->impostos->ir = $Impostos->ir;
        }
        if (isset($Impostos->csll)) {
            $servico->impostos->csll = $Impostos->csll;
        }
        if (isset($Impostos->descricaoImpostos)) {
            $servico->impostos->descricao_impostos = $Impostos->descricaoImpostos;
        }
    }

    /**
     * Cria o JSON do Intermediário.
     * @param stdClass $servico
     * @param Intermediario $Intermediario
     */
    private function convertIntermediarioServicoToJSON(stdClass $servico, Intermediario $Intermediario)
    {
        $servico->intermediario = new stdClass();
        if (isset($Intermediario->cpf)) {
            $servico->intermediario->cpf = $Intermediario->cpf;
        }
        if (isset($Intermediario->nomeCompleto)) {
            $servico->intermediario->nome_completo = $Intermediario->nomeCompleto;
        }
        if (isset($Intermediario->cnpj)) {
            $servico->intermediario->cnpj = $Intermediario->cnpj;
        }
        if (isset($Intermediario->razaoSocial)) {
            $servico->intermediario->razao_social = $Intermediario->razaoSocial;
        }
        if (isset($Intermediario->inscricaoMunicipal)) {
            $servico->intermediario->im = $Intermediario->inscricaoMunicipal;
        }
    }

    /**
     * Cria o JSON do Tomador.
     * @param stdClass $rps
     * @param Tomador $Tomador
     */
    private function convertTomadorToJSON(stdClass $rps, Tomador $Tomador)
    {
        $rps->tomador = new stdClass();
        if (isset($Tomador->cpf)) {
            $rps->tomador->cpf = $Tomador->cpf;
        }
        if (isset($Tomador->nomeCompleto)) {
            $rps->tomador->nome_completo = $Tomador->nomeCompleto;
        }
        if (isset($Tomador->cnpj)) {
            $rps->tomador->cnpj = $Tomador->cnpj;
        }
        if (isset($Tomador->razaoSocial)) {
            $rps->tomador->razao_social = $Tomador->razaoSocial;
        }
        if (isset($Tomador->inscricaoMunicipal)) {
            $rps->tomador->im = $Tomador->inscricaoMunicipal;
        }
        if (isset($Tomador->identificacaoFiscal)) {
            $rps->tomador->nif = $Tomador->identificacaoFiscal;
        }
        if (isset($Tomador->endereco)) {
            $rps->tomador->endereco = $Tomador->endereco;
        }
        if (isset($Tomador->numero)) {
            $rps->tomador->numero = $Tomador->numero;
        }
        if (isset($Tomador->complemento)) {
            $rps->tomador->complemento = $Tomador->complemento;
        }
        if (isset($Tomador->bairro)) {
            $rps->tomador->bairro = $Tomador->bairro;
        }
        if (isset($Tomador->cidade)) {
            $rps->tomador->cidade = $Tomador->cidade;
        }
        if (isset($Tomador->uf)) {
            $rps->tomador->uf = $Tomador->uf;
        }
        if (isset($Tomador->cep)) {
            $rps->tomador->cep = $Tomador->cep;
        }
        if (isset($Tomador->email)) {
            $rps->tomador->email = $Tomador->email;
        }
        if (isset($Tomador->telefone)) {
            $rps->tomador->telefone = $Tomador->telefone;
        }
        if (isset($Tomador->inscricaoEstadual)) {
            $rps->tomador->ie = $Tomador->inscricaoEstadual;
        }
        if (isset($Tomador->documentoEstrangeiro)) {
            $rps->tomador->documento_estrangeiro = $Tomador->documentoEstrangeiro;
        }
        if (isset($Tomador->cidadeEstrangeira)) {
            $rps->tomador->cidade_estrangeira = $Tomador->cidadeEstrangeira;
        }
        if (isset($Tomador->pais)) {
            $rps->tomador->pais = $Tomador->pais;
        }
    }

    /**
     * Cria o JSON de construção civil
     * @param stdClass $rps
     * @param ConstrucaoCivil $ConstrucaoCivil
     */
    public function convertConstrucaoCivilToJSON(stdClass $rps, ConstrucaoCivil $ConstrucaoCivil)
    {
        $rps->construcao_civil = new stdClass();
        if (isset($ConstrucaoCivil->codigoObra)) {
            $rps->construcao_civil->codigo_obra = $ConstrucaoCivil->codigoObra;
        }
        if (isset($ConstrucaoCivil->art)) {
            $rps->construcao_civil->art = $ConstrucaoCivil->art;
        }
    }
}
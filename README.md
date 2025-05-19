
<p align="center">
  <img src="https://wmbr.s3.amazonaws.com/img/logo_webmaniabr_github2.png">
</p>

# NFS-e PHP SDK
SDK de comunicação com API 2.0 da Webmania para NFS-e.
Através do emissor de Nota Fiscal de Serviço da Webmania®, você conta com a emissão e arquivamento das suas NFS-e, cálculo automático de impostos, impressão e envio automático de e-mails para os tomadores. Realize a integração do seu sistema com esta SDK para a NFS-e.

- Emissor de Nota Fiscal Webmania®: [Saiba mais](https://webmaniabr.com/nota-fiscal-eletronica/)
- Documentação REST API: [Visualizar](https://webmaniabr.com/docs/rest-api-nfse/)

## Requisitos

- Contrate um dos planos de NFS-e da Webmania® para obter suas credenciais de acesso: [Conheça os Planos](https://webmaniabr.com/nota-fiscal-eletronica/#plans-section).
- Obtenha o [Composer](https://getcomposer.org/) e instale o pacote da SDK e suas dependências.
- Utilize as ferramentas disponibilizadas pela SDK: [Veja Exemplos de Uso](https://github.com/webmaniabr/NFSe-PHP-SDK/tree/main/sample)

## Endpoints

A SDK possui os recursos necessários para utilizar os endpoints de Emissão, Consulta, Cancelamento e Substituição de NFS-e.

## Utilização
Instale o módulo da Webmania® via composer ou baixe nosso repositório e utilize as classes de emissão mencionadas mais abaixo:

```php
composer require webmaniabr/nfse
```

Após executar o composer, adicione o require no topo do seu arquivo, dessa forma as classes da SDK serão carregadas automaticamente.

```php
require_once __DIR__ . '/vendor/autoload.php';
```

Para emissão, podem ser usadas as classes [NFSe](https://github.com/webmaniabr/NFSe-PHP-SDK/blob/main/src/Models/NFSe.php) ou [LoteRPS](https://github.com/webmaniabr/NFSe-PHP-SDK/blob/main/src/Models/LoteRPS.php)

```php
\Webmaniabr\Nfse\Api\Connection::getInstance()->setBearerToken(SEU_BEARER_TOKEN); // A classe Connection aplica o padrão Singleton, e sempre deve ser chamada pelo menos uma vez antes da emissão para definir o valor do Bearer Token
$nfse = new \Webmaniabr\Nfse\Models\NFSe();
$nfse->Servico->valorServico = 200;
$nfse->Servico->discriminacao = "Descrição do serviço prestado";
$nfse->Tomador->nomeCompleto = "Fulano Ciclano Beltrano";
$nfse->Tomador->cpf = "00000000000";
//...
echo $nfse->emitir()->getMessage();
```

## Suporte

Qualquer dúvida entre em contato na nossa [Central de Ajuda](https://ajuda.webmaniabr.com) ou acesse o [Painel de Controle](https://webmaniabr.com/painel/) para conversar em tempo real no Chat ou Abrir um chamado.

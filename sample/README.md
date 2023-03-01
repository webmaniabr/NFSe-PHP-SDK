
<p align="center">
  <img src="https://wmbr.s3.amazonaws.com/img/logo_webmaniabr_github.png">
</p>

# Exemplos de uso *NFS-e PHP SDK*
O diretório /sample doi disponipilizado para exemplificar o uso desta SDK, a implementação da utilização de cada uma das operações está no início de cada um dos arquivos respectivos à uma operação.

## Como utilizar

Após realizar a instalação da SDK ([Descrita Aqui](https://github.com/webmaniabrteam/nfse_php_sdk/blob/main/README.md)) execute o comando abaixo para iniciar o WebServer que vem embutido no PHP, substituido **diretorio_da_sdk** pelo diretório onde está instalada a SDK.

```bash
php -S 127.0.0.1:80 -t "*diretorio_da_sdk*/sample"
```

Dependendo do tipo de instalação que foi realizado, será necessário alterar o diretório do autoloader no arquivo [autoload.php](https://github.com/webmaniabrteam/nfse_php_sdk/blob/main/sample/autoload.php)

## Operações

A SDK possui os recursos necessários para utilizar os endpoints de Emissão, Consulta, Cancelamento e Substituição de NFS-e, no contexto da SDK, a comunicação com cada um desses endpoints são chamados de Operação.

### [Emissão](https://github.com/webmaniabrteam/nfse_php_sdk/blob/main/src/Api/Operations/Issue.php)
### [Consulta](https://github.com/webmaniabrteam/nfse_php_sdk/blob/main/src/Api/Operations/Consult.php)
### [Substituição](https://github.com/webmaniabrteam/nfse_php_sdk/blob/main/src/Api/Operations/Replace.php)
### [Cancelamento](https://github.com/webmaniabrteam/nfse_php_sdk/blob/main/src/Api/Operations/Cancelamento.php)
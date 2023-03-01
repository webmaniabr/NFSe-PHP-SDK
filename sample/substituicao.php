<?php

use Webmaniabr\Nfse\Api\Connection;
use Webmaniabr\Nfse\Api\Exceptions\APIException;
use Webmaniabr\Nfse\Models\NFSe;

if (!isset($_GET['bearer']) || trim($_GET['bearer']) == '') {
    header('Location: /');
}

$json = json_decode(file_get_contents('php://input'));
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($json->servico) && isset($json->verificacao) && isset($json->motivo)) {
    include_once('./autoload.php');
    Connection::getInstance()->setBearerToken($_GET['bearer']);
    $nfse = new NFSe();
    foreach ($json->servico as $attribute => $value) {
        if (property_exists($nfse->Servico, $attribute)) {
            $nfse->Servico->{$attribute} = $value;
        }
    }
    foreach ($json->impostos as $attribute => $value) {
        if (property_exists($nfse->Servico->Impostos, $attribute)) {
            $nfse->Servico->Impostos->{$attribute} = $value;
        }
    }
    foreach ($json->tomador as $attribute => $value) {
        if (property_exists($nfse->Tomador, $attribute)) {
            $nfse->Tomador->{$attribute} = $value;
        }
    }
    try {
        $response = $nfse->substituirHomologacao($json->verificacao, $json->motivo);
        response($response->getMessage());
    } catch (\Throwable $th) {
        response((object) [ 'exception' => $th->getMessage() ]);
    } catch (APIException $a) {
        response((object) [ 'error' => $a->getMessage() ]);
    }
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Webmania® NFS-e API SDK</title>
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: "Lucida Console", "Courier New", monospace;
                line-height: 1.2;
            }
            #container_box {
                padding: 10px;
                width: 100%;
            }
            #container_left {
                width: 25%;
                background-color: #222427;
                padding: 10px 20px 10px 20px;
                border-radius: 7px;
                height: 97vh;
                float: left;
            }
            #container_right {
                width: 74%;
                background-color: #dcdcdc;
                padding: 11px;
                border-radius: 7px;
                height: 97vh;
                float: right;
            }
            #logo {
                padding: 10px;
            }
            #sdk {
                text-align: center;
                font-weight: bolder;
                color: #f3f6f4;
                text-decoration: underline;
            }
            #list_box {
                background-color: #f3f6f4;
                width: 100%;
                padding: 5px;
                border-radius: 7px;
            }
            .list_option {
                background-color: #dcdcdc;
                padding: 10px;
                border: 2px solid #FFFFFF;
                border-radius: 7px;
                text-align: center;
                line-height: 0.8;
                cursor: pointer;
                margin: 3px;
            }
            .list_option:hover {
                background-color: #23BE7D;
                border-color: #222427;
                font-weight: bold;
            }
            .list_option_selected {
                background-color: #23BE7D;
                border-color: #222427;
                font-weight: bold;
            }
            .card {
                background-color: #FFFFFF;
                border-radius: 7px;
                padding: 10px;
                width: 100%;
                height: 100%;
            }
            #container_envio {
                width: 40%;
                float: left;
                overflow-y: scroll;
                max-height: 100%;
            }
            #container_retorno {
                width: 60%;
                height: 100%;
                float: left;
            }
            #retorno {
                width: 100%;
                height: 55%;
                border-radius: 5px;
            }
            #erro {
                width: 100%;
                height: 38%;
                border: 1px solid black;
                border-radius: 5px;
            }
            #executar {
                padding: 5px;
                margin: 10px;
                background-color: #23BE7D;
                border-radius: 7px;
                font-weight: bold;
                cursor: pointer;
            }
            #executar:hover {
                background-color: green;
                font-weight: bolder;
            }
        </style>
    </head>
    <body>
        <div id="container_box">
            <div id="container_left">
                <div id="logo">
                    <svg version="1.1" width="100%" id="webmania" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 195 37" style="enable-background:new 0 0 195 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0{fill:#23BE7D;}
                            .st1{fill:#FFFFFF;}
                        </style>
                        <g>
                            <path class="st0" d="M29.66,3.59L16.8,1.95c-0.22-0.03-0.4-0.06-0.7-0.1c-1.57-0.2-2.33-0.13-2.59-0.11
                                C7.42,2.26,2.49,8.31,2.5,12.4v13.83c0,3.17,3.38,9.41,9.84,9.03c0.48-0.03,1.06-0.08,1.25-0.12c0.65-0.12,1.12-0.2,1.96-0.36
                                l14.24-2.7c4.73-0.86,6.88-6.41,6.92-10.08V10.33C36.71,6.42,33.72,4.1,29.66,3.59z M35.57,21.77c0,3.6-2.23,8.47-6.52,9.3
                                l-13.18,2.41c-5.52,1.1-10.25-4.29-10.25-7.89l0.01-12.76C5.62,8.52,10.95,2.64,17.08,3.17l11.97,1.56c3.88,0.54,6.51,2.6,6.51,6.2
                                V21.77z"/>
                        </g>
                        <path class="st1" d="M96.09,27.51c-2.38,0-4.44-0.85-6.12-2.53c-1.69-1.67-2.55-3.72-2.56-6.11V6.28c0-0.57,0.21-1.07,0.62-1.48
                            c0.41-0.4,0.9-0.6,1.47-0.6h0.04c0.56,0,1.05,0.2,1.46,0.6c0.41,0.41,0.62,0.91,0.62,1.48v4.97l0.21-0.13
                            c1.09-0.65,2.52-0.98,4.26-0.98c2.38,0,4.45,0.86,6.14,2.55c1.69,1.69,2.55,3.76,2.55,6.14c0,2.38-0.86,4.45-2.55,6.14
                            C100.54,26.66,98.47,27.51,96.09,27.51z M96.09,14.39c-1.26,0-2.29,0.43-3.18,1.31c-0.87,0.88-1.3,1.92-1.3,3.18
                            c0,1.25,0.42,2.28,1.3,3.16c0.88,0.88,1.92,1.31,3.18,1.31c1.25,0,2.28-0.43,3.16-1.31c0.88-0.88,1.31-1.92,1.31-3.16
                            c0-1.25-0.43-2.29-1.31-3.18C98.37,14.82,97.34,14.39,96.09,14.39z"/>
                        <path class="st1" d="M129.38,27.51c-0.59,0-1.08-0.21-1.47-0.63c-0.4-0.38-0.61-0.88-0.61-1.46v-7.98c0-0.87-0.3-1.58-0.9-2.19
                            c-0.61-0.61-1.33-0.9-2.2-0.9c-0.87,0-1.58,0.3-2.19,0.9c-0.61,0.61-0.9,1.33-0.9,2.19v7.98c0,0.59-0.21,1.08-0.63,1.47
                            c-0.38,0.4-0.88,0.61-1.46,0.61c-0.59,0-1.1-0.21-1.51-0.62c-0.41-0.39-0.62-0.88-0.62-1.47v-7.98c0-0.86-0.3-1.58-0.9-2.19
                            c-0.61-0.61-1.33-0.9-2.19-0.9c-0.87,0-1.58,0.3-2.19,0.9c-0.61,0.61-0.9,1.33-0.9,2.19v7.98c0,0.58-0.21,1.08-0.63,1.47
                            c-0.41,0.41-0.9,0.61-1.46,0.61h-0.04c-0.56,0-1.06-0.21-1.47-0.62c-0.41-0.39-0.62-0.88-0.62-1.47v-7.98c0-2,0.72-3.73,2.14-5.16
                            c1.42-1.42,3.16-2.14,5.16-2.14c2.17,0,3.89,0.67,5.1,1.99l0.1,0.11l0.1-0.11c1.21-1.32,2.92-1.99,5.09-1.99
                            c2.01,0,3.74,0.72,5.16,2.14c1.42,1.43,2.14,3.17,2.14,5.16v7.98c0,0.57-0.2,1.06-0.6,1.47c-0.41,0.41-0.91,0.62-1.48,0.62H129.38z"
                            />
                        <path class="st1" d="M60.08,27.51c-2.17,0-3.89-0.67-5.1-1.99l-0.1-0.11l-0.1,0.11c-1.21,1.32-2.92,1.99-5.09,1.99
                            c-2.01,0-3.74-0.72-5.16-2.14c-1.42-1.43-2.14-3.17-2.14-5.16v-7.98c0-0.57,0.2-1.06,0.6-1.47c0.41-0.41,0.91-0.62,1.48-0.62
                            c0.61,0,1.11,0.21,1.5,0.63c0.4,0.38,0.61,0.88,0.61,1.46v7.98c0,0.87,0.3,1.58,0.9,2.19c0.61,0.61,1.33,0.9,2.2,0.9
                            c0.87,0,1.58-0.3,2.19-0.9c0.61-0.61,0.9-1.33,0.9-2.19v-7.98c0-0.59,0.21-1.08,0.63-1.47c0.38-0.4,0.88-0.61,1.46-0.61
                            c0.59,0,1.1,0.21,1.51,0.62c0.41,0.39,0.62,0.88,0.62,1.47v7.98c0,0.86,0.3,1.58,0.9,2.19c0.61,0.61,1.33,0.9,2.19,0.9
                            s1.58-0.3,2.19-0.9s0.9-1.33,0.9-2.19v-7.98c0-0.58,0.21-1.08,0.63-1.47c0.41-0.41,0.9-0.61,1.46-0.61h0.04
                            c0.56,0,1.06,0.21,1.47,0.62c0.41,0.39,0.62,0.88,0.62,1.47v7.98c0,2-0.72,3.73-2.14,5.16C63.82,26.79,62.09,27.51,60.08,27.51z"/>
                        <path class="st1" d="M148.43,27.51c-0.56,0-1.06-0.21-1.47-0.62c-0.2-0.18-0.35-0.4-0.45-0.63l-0.07-0.16l-0.14,0.11
                            c-1.12,0.86-2.61,1.3-4.43,1.3c-2.38,0-4.45-0.86-6.14-2.55c-1.69-1.69-2.55-3.75-2.55-6.14c0-2.38,0.86-4.45,2.55-6.14
                            c1.69-1.69,3.75-2.55,6.14-2.55c2.38,0,4.45,0.86,6.14,2.55c1.69,1.69,2.55,3.76,2.55,6.14v6.6c0,0.59-0.21,1.08-0.63,1.47
                            c-0.41,0.41-0.9,0.61-1.46,0.61H148.43z M141.88,14.36c-1.26,0-2.29,0.43-3.18,1.31c-0.87,0.88-1.3,1.92-1.3,3.16
                            c0,1.26,0.42,2.3,1.3,3.18c0.88,0.87,1.92,1.3,3.17,1.3c1.26,0,2.29-0.42,3.16-1.3c0.88-0.88,1.31-1.92,1.31-3.18
                            c0-1.25-0.43-2.28-1.31-3.16C144.16,14.79,143.12,14.36,141.88,14.36z"/>
                        <path class="st1" d="M164.83,27.51c-0.57,0-1.07-0.21-1.48-0.62c-0.41-0.39-0.62-0.88-0.62-1.47V17.5c0-0.88-0.3-1.6-0.91-2.22
                            c-0.62-0.62-1.34-0.92-2.22-0.92c-0.88,0-1.62,0.3-2.23,0.92c-0.61,0.62-0.9,1.34-0.9,2.22v7.93c0,0.59-0.21,1.08-0.63,1.47
                            c-0.41,0.41-0.9,0.61-1.46,0.61h-0.04c-0.56,0-1.06-0.21-1.47-0.62c-0.41-0.39-0.62-0.88-0.62-1.47V17.5c0-2.02,0.73-3.76,2.16-5.19
                            c1.43-1.43,3.18-2.16,5.19-2.16c2.01,0,3.75,0.73,5.18,2.16c1.43,1.43,2.16,3.18,2.16,5.19v7.93c0,0.59-0.21,1.08-0.63,1.47
                            c-0.38,0.4-0.88,0.61-1.46,0.61H164.83z"/>
                        <path class="st1" d="M171.32,27.51c-0.57,0-1.07-0.21-1.48-0.62c-0.41-0.39-0.62-0.88-0.62-1.47V12.25c0-0.57,0.21-1.07,0.62-1.48
                            c0.41-0.41,0.91-0.62,1.48-0.62c0.6,0,1.11,0.21,1.5,0.63c0.41,0.41,0.61,0.9,0.61,1.47v13.19c0,0.58-0.21,1.08-0.63,1.47
                            c-0.38,0.4-0.88,0.61-1.46,0.61H171.32z M171.33,8.92c-0.65,0-1.21-0.23-1.67-0.69c-0.46-0.46-0.69-1.02-0.69-1.67
                            c0-0.64,0.23-1.2,0.69-1.65c0.46-0.46,1.02-0.69,1.67-0.69c0.64,0,1.2,0.23,1.65,0.69c0.47,0.45,0.71,1,0.71,1.65
                            c0,0.66-0.24,1.22-0.71,1.67C172.52,8.69,171.97,8.92,171.33,8.92z"/>
                        <path class="st1" d="M190.37,27.51c-0.56,0-1.06-0.21-1.47-0.62c-0.2-0.19-0.35-0.4-0.45-0.63l-0.07-0.16l-0.14,0.11
                            c-1.12,0.86-2.61,1.3-4.43,1.3c-2.38,0-4.45-0.86-6.14-2.55c-1.69-1.69-2.55-3.75-2.55-6.14c0-2.38,0.86-4.45,2.55-6.14
                            c1.69-1.69,3.75-2.55,6.14-2.55c2.38,0,4.45,0.86,6.14,2.55c1.69,1.69,2.55,3.75,2.55,6.14v6.6c0,0.59-0.21,1.08-0.63,1.47
                            c-0.41,0.41-0.9,0.61-1.46,0.61H190.37z M183.82,14.36c-1.26,0-2.29,0.43-3.18,1.31c-0.87,0.88-1.3,1.92-1.3,3.16
                            c0,1.26,0.42,2.3,1.3,3.18c0.88,0.87,1.92,1.3,3.17,1.3c1.25,0,2.29-0.42,3.16-1.3c0.88-0.88,1.31-1.92,1.31-3.18
                            c0-1.25-0.43-2.28-1.31-3.16C186.1,14.79,185.06,14.36,183.82,14.36z"/>
                        <g>
                            <path class="st0" d="M32.88,20.01V12.7c0-3.4-4.24-3.79-4.24-0.07v7.09c0,2.07-3.02,2.24-3.02,0.23v-8.35c0-3.08-5.1-4.2-5.1,0.15
                                v8.51c0,2.84-3.95,3.86-3.95,0.35l0.05-9.38c0-4.46-6.6-4.88-6.6,0.59v10.02v0.94c0,5.6,6.93,9.14,12.83,3.95
                                C24.98,28.83,32.88,27.91,32.88,20.01z"/>
                        </g>
                        <path class="st1" d="M77.61,27.51c-2.38,0-4.45-0.86-6.14-2.55c-1.69-1.69-2.55-3.75-2.55-6.14c0-2.38,0.86-4.45,2.55-6.14
                            c1.69-1.69,3.75-2.55,6.14-2.55c1.72,0,3.31,0.48,4.74,1.42c1.41,0.92,2.47,2.15,3.15,3.65c0.14,0.28,0.2,0.58,0.2,0.88
                            c0,0.24-0.05,0.49-0.14,0.73c-0.19,0.54-0.56,0.93-1.1,1.17c-1.35,0.61-3.13,1.41-5.34,2.41c-2.04,0.92-3.44,1.56-4.21,1.91
                            l-0.21,0.09l0.17,0.14c0.66,0.54,1.55,0.81,2.73,0.81c0.97,0,1.83-0.28,2.62-0.85c0.61-0.44,1.06-0.97,1.38-1.61l0.02-0.03
                            c0.54-1.06,1.44-1.7,2.41-1.7c0.62,0,1.17,0.26,1.5,0.73c0.38,0.52,0.44,1.24,0.18,2.03l-0.01,0.04c-0.05,0.13-0.09,0.26-0.15,0.38
                            c-0.63,1.45-1.59,2.63-2.88,3.55C81.18,26.96,79.48,27.51,77.61,27.51z M77.61,14.39c-1.26,0-2.29,0.43-3.18,1.31
                            c-0.72,0.72-1.13,1.55-1.25,2.52l-0.03,0.25l7.22-3.24l-0.19-0.14C79.54,14.61,78.7,14.39,77.61,14.39z"/>
                    </svg>
                    <h1 id="sdk">NFS-e API SDK</h1>
                </div>
                <div id="list_box">
                    <div class="list_option" onclick="window.location.href = `/${window.location.search}`">INTRODUÇÃO</div>
                    <div class="list_option" onclick="window.location.href = `/emissao.php${window.location.search}`">EMISSÃO</div>
                    <div class="list_option" onclick="window.location.href = `/consulta.php${window.location.search}`">CONSULTA</div>
                    <div class="list_option list_option_selected" onclick="window.location.reload()">SUBSTITUIÇÃO</div>
                    <div class="list_option" onclick="window.location.href = `/cancelamento.php${window.location.search}`">CANCELAMENTO</div>
                </div>
            </div>
            <div id="container_right">
                <div class="card">
                    <div id="container_envio">
                        <h5>NFS-e a ser substituída:</h5>
                        <table>
                            <tr>
                                <th>Cód. Verificação</th>
                                <th>Motivo</th>
                            </tr>
                            <tr>
                                <td><input type="text" value="XXXXXXX" id="verificacao"></td>
                                <td><input type="text" value="1" id="motivo"></td>
                            </tr>
                        </table>
                        <h5>Serviço Prestado:</h5>
                        <table id="servico">
                            <tr>
                                <th>Propriedade</th>
                                <th>Valor</th>
                            </tr>
                            <tr>
                                <td><input type="text" value="valorServico"></td>
                                <td><input type="text" value="1"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="discriminacao"></td>
                                <td><input type="text" value="Teste de emissão"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="codigoServico"></td>
                                <td><input type="text" value="108"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="naturezaOperacao"></td>
                                <td><input type="text" value="1"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="issRetido"></td>
                                <td><input type="text" value="0"></td>
                            </tr>
                        </table>
                        <button onclick="novaPropriedade('servico');">Nova Propriedade</button>
                        <br/>
                        <br/>
                        <h5>Impostos:</h5>
                        <table id="impostos">
                            <tr>
                                <th>Propriedade</th>
                                <th>Valor</th>
                            </tr>
                            <tr>
                                <td><input type="text" value="iss"></td>
                                <td><input type="text" value="2"></td>
                            </tr>
                        </table>
                        <button onclick="novaPropriedade('impostos');">Nova Propriedade</button>
                        <br/>
                        <br/>
                        <h5>Tomador:</h5>
                        <table id="tomador">
                            <tr>
                                <th>Propriedade</th>
                                <th>Valor</th>
                            </tr>
                            <tr>
                                <td><input type="text" value="razaoSocial"></td>
                                <td><input type="text" value="Teste emissao"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="cnpj"></td>
                                <td><input type="text" value="00000000000000"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="cep"></td>
                                <td><input type="text" value="00000000"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="endereco"></td>
                                <td><input type="text" value="Rua dos Patos"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="numero"></td>
                                <td><input type="text" value="24"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="complemento"></td>
                                <td><input type="text" value="Casa"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="bairro"></td>
                                <td><input type="text" value="Patagônia"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="cidade"></td>
                                <td><input type="text" value="Patolândia"></td>
                            </tr>
                            <tr>
                                <td><input type="text" value="uf"></td>
                                <td><input type="text" value="PR"></td>
                            </tr>
                        </table>
                        <button onclick="novaPropriedade('tomador');">Nova Propriedade</button>
                        </textarea>
                        <div>
                            <button id="executar" onclick="executa();">EXECUTAR</button>
                            <script>
                                function novaPropriedade(tabela)
                                {
                                    var tbody = document.getElementById(tabela).getElementsByTagName('tbody')[0],
                                        tr    = document.createElement('tr');
                                    tr.innerHTML = "<td><input type=\"text\" value=\"\"></td><td><input type=\"text\" value=\"\"></td>";
                                    tbody.appendChild(tr);
                                }
    
                                function executa() 
                                {
                                    var servicosRows = document.getElementById('servico').getElementsByTagName('tbody')[0].children,
                                        servicos = {};
                                    for (let index = 1; index < servicosRows.length; index++) {
                                        let celulas = servicosRows[index].children;
                                        if (celulas[0].firstChild.value && celulas[1].firstChild.value) {
                                            servicos[celulas[0].firstChild.value] = celulas[1].firstChild.value;
                                        }
                                    }
                                    var tomadorRows = document.getElementById('tomador').getElementsByTagName('tbody')[0].children,
                                        tomador = {};
                                    for (let index = 1; index < tomadorRows.length; index++) {
                                        let celulas = tomadorRows[index].children;
                                        if (celulas[0].firstChild.value && celulas[1].firstChild.value) {
                                            tomador[celulas[0].firstChild.value] = celulas[1].firstChild.value;
                                        }
                                    }
                                    var impostosRows = document.getElementById('impostos').getElementsByTagName('tbody')[0].children,
                                        impostos = {};
                                    for (let index = 1; index < impostosRows.length; index++) {
                                        let celulas = impostosRows[index].children;
                                        if (celulas[0].firstChild.value && celulas[1].firstChild.value) {
                                            impostos[celulas[0].firstChild.value] = celulas[1].firstChild.value;
                                        }
                                    }
                                    fetch(window.location.href, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({ "verificacao": document.getElementById('verificacao').value,
                                                               "motivo": document.getElementById('motivo').value,
                                                               "servico": servicos,
                                                               "impostos": impostos,
                                                               "tomador": tomador })
                                    }).then((retorno) => {
                                        return retorno.text();
                                    }).then((data) => {
                                        try {
                                            var json = JSON.parse(JSON.parse(data));
                                            document.getElementById('retorno').innerHTML = JSON.stringify(json, undefined, 2);
                                        } catch (error) {
                                            document.getElementById('retorno').innerText = data;
                                        }
                                        document.getElementById('erro').innerText = '';
                                    }).catch((error) => {
                                        document.getElementById('retorno').innerText = '';
                                        document.getElementById('erro').innerText = error;
                                    });
                                }
                            </script>
                        </div>
                    </div>
                    <div id="container_retorno">
                        <h4>Retorno:</h4>
                        <textarea id="retorno"></textarea>
                        <h4>Erro:</h4>
                        <pre id="erro"></pre>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
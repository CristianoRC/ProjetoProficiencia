<?php
require "database.php";
require "crudVeiculo.php";

if (isset($_REQUEST)) {
    if ($_REQUEST['method'] == 'post') {
        cadastrarLocacao();
    }
}

function cadastrarLocacao()
{
    $erros = "";

    $cliente = $_REQUEST['cliente']; //CPF
    $veiculo = $_REQUEST['veiculo']; //Placa
    $dataInicial = $_REQUEST['dataInicial'];
    $dataFinal = $_REQUEST['dataFinal'];

    $dados = array(
        'cliente' => $cliente,
        'veiculo' => $veiculo,
        'data_inicial' => $dataInicial,
        'data_final' => $dataFinal,
    );

    foreach ($dados as $key => $value) {
        if (!isset($value) || trim($value) == '') {
            $erros .= "_$key=$key Invalido&";
        }
    }

    if ($erros == "") {
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_insert($conexao, 'locacao', $dados);

        if ($response) {
            atualizarDisponibilidade('f',$dados['veiculo'],false);
            header("Location: http://localhost/locacoes.php?sucesso=true&mensagem=Locação cadastrada!", true, 301);
            exit();
        } else {
            header("Location: http://localhost/criarLocacao.php?_reponse=$response", true, 301);
            exit();
        }
    } else {
        header("Location: http://localhost/criarLocacao.php?$erros", true, 301);
        exit();
    }
}

function listarLocacoes()
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_query($conexao, "select * from locacao");

    if ($response) {
        return pg_fetch_all($response);
    } else {
        return null;
    }

}

<?php
require "database.php";

if (isset($_REQUEST)) {
    if ($_REQUEST['method'] == 'post') {
        cadastrar();
    }
    if ($_REQUEST['method'] == 'delete') {
        if (isset($_REQUEST['placa'])) {
            deletar($_REQUEST['placa']);
        } else {
            header("Location: http://localhost/clientes.php?sucesso=false&mensagem=Não foi possível deletar o veículo!", true, 301);
            exit();
        }
    }
}

function cadastrar()
{
    $erros = "";

    $placa = $_REQUEST['placa'];
    $marca = $_REQUEST['marca'];
    $modelo = $_REQUEST['modelo'];
    $cor = $_REQUEST['cor'];
    $diaria = $_REQUEST['diaria'];

    $dados = array(
        'placa' => strtoupper($placa),
        'marca' => $marca,
        'modelo' => $modelo,
        'cor' => $cor,
        'diaria' => $diaria,
        'disponivel' => true
    );

    foreach ($dados as $key => $value) {
        if (!isset($value) || trim($value) == '') {
            $erros .= "_$key=$key Invalido(a)&";
        }
    }

    if ($erros == "") {
        //TODO: Verificar como pegar o $conexao do arquivo database.php
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_insert($conexao, 'veiculo', $dados);

        if ($response) {
            header("Location: http://localhost/veiculos.php?sucesso=true&mensagem=Veiculo criado com sucesso!", true, 301);
            exit();
        } else {
            header("Location: http://localhost/criarVeiculo.php?_reponse=$response", true, 301);
            exit();
        }
    } else {
        header("Location: http://localhost/criarVeiculo.php?$erros", true, 301);
        exit();
    }
}

function listarVeiculos($status)
{
    $sql = "select * from veiculo";

    if($status === 'Indisponível')
        $sql .= " where disponivel='f'";
    else if($status === 'Disponível')
        $sql .= " where disponivel='t'";

    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_query($conexao,$sql );

    if ($response) {
        return pg_fetch_all($response);
    } else {
        return null;
    }
}

function deletar($placa)
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $veiculo = array('placa' => $placa);

    $response = pg_delete($conexao, 'veiculo', $veiculo);
    if ($response) {
        header("Location: http://localhost/veiculos.php?sucesso=true&mensagem=Veículo deletado com sucesso!", true, 301);
        exit();
    }
}

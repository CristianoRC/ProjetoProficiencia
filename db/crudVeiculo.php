<?php
//TODO: Resolver problemas de cache

if (isset($_REQUEST)) {
    if ($_REQUEST['method'] == 'post') {
        cadastrarVeiculo();
    } else if ($_REQUEST['method'] == 'delete') {
        if (isset($_REQUEST['placa'])) {
            deletarVeiculo($_REQUEST['placa']);
        } else {
            header("Location: http://localhost/clientes.php?sucesso=false&mensagem=Não foi possível deletar o veículo!", true, 301);
            exit();
        }
    } else if ($_REQUEST['method'] == 'put') {
        atualizarDisponibilidade($_REQUEST['placa'], true);
    }
}

function atualizarDisponibilidade($placa, $retornar)
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    pg_update($conexao, 'veiculo', array('disponivel' => 't'), array('placa' => $placa));

    if ($retornar == 1) {
        header("Location: http://localhost/locacoes.php?sucesso=true&mensagem=Veiculo $placa, já está disponível!", true, 301);
    }
}

function cadastrarVeiculo()
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
        'disponivel' => true,
        'deletado' => false,
    );

    foreach ($dados as $key => $value) {
        if (!isset($value) || trim($value) == '') {
            $erros .= "_$key=$key Invalido(a)&";
        }
    }

    if ($erros == "") {
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
    $sql = "select placa, marca, modelo, cor, diaria, disponivel from veiculo";

    if ($status === 'Indisponível') {
        $sql .= " where disponivel='f' AND deletado='f'";
    } else if ($status === 'Disponível') {
        $sql .= " where disponivel='t' AND deletado='f'";
    } else {
        $sql .= " where deletado='f'";
    }

    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_query($conexao, $sql);

    if ($response) {
        return pg_fetch_all($response);
    } else {
        return null;
    }
}

function deletarVeiculo($placa)
{
    if (veiculoEstaDisponivel($placa) == 1) {
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_update($conexao, 'veiculo', array('deletado' => 't'), array('placa' => $placa));

        if ($response) {
            header("Location: http://localhost/veiculos.php?sucesso=true&mensagem=Veículo deletado com sucesso!", true, 301);
            exit();
        }
    } else {
        header("Location: http://localhost/veiculos.php?sucesso=false&mensagem=Veículo não pode ser deletado, está alugado.", true, 301);
        exit();
    }

}

function veiculoEstaDisponivel($placa)
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_query($conexao, "select disponivel from veiculo where placa='$placa'");

    if ($response) {
        $valorString = pg_fetch_row($response);

        if ($valorString[0] == 'f') {
            return false;
        }
        return true;

    } else {
        return false;
    }
}

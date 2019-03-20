<?php
if (isset($_REQUEST)) {
    if ($_REQUEST['method'] == 'post') {
        cadastrarLocacao();
    }
}

function cadastrarLocacao()
{
    $parametros = "";

    $cliente = $_REQUEST['cliente']; //CPF
    $veiculo = $_REQUEST['veiculo']; //Placa
    $dataInicial = $_REQUEST['dataInicial'];
    $dataFinal = $_REQUEST['dataFinal'];

    $dados = array(
        'cliente' => $cliente,
        'veiculo' => $veiculo,
        'data_inicial' => $dataInicial,
        'data_final' => $dataFinal,
        'devolvido' => 'f',
    );

    foreach ($dados as $key => $value) {
        if (!isset($value) || trim($value) == '') {
            $parametros .= "_$key=$key Invalido&";
        }
    }

    if ($dataInicial > $dataFinal) {
        $parametros .= "_datas=Data inicial não pode ser menor que a final";
    }

    if ($parametros == "") {
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_insert($conexao, 'locacao', $dados);

        if ($response) {
            header("Location: http://localhost/locacoes.php?sucesso=true&mensagem=Locação cadastrada!", true, 301);
            pg_update($conexao, 'veiculo', array('disponivel' => 'f'), array('placa' => $veiculo));
            exit();
        } else {
            header("Location: http://localhost/criarLocacao.php?_reponse=$response", true, 301);
            exit();
        }
    } else {
        header("Location: http://localhost/criarLocacao.php?$parametros", true, 301);
        exit();
    }
}

function listarLocacoes()
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_query($conexao, "select * from locacao order by id desc");

    if ($response) {
        return pg_fetch_all($response);
    } else {
        return null;
    }

}

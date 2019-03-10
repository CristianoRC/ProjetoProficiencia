<?php
require "database.php";

if (isset($_REQUEST)) {
    if ($_REQUEST['method'] == 'post') {
        cadastrar();
    }
}

function cadastrar()
{
    $erros = "";

    $nome = $_REQUEST['nome'];
    $cpf = $_REQUEST['cpf'];
    $email = $_REQUEST['email'];
    $telefone = $_REQUEST['telefone'];

    $dados = array(
        'cpf' => $cpf,
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
    );

    foreach ($dados as $key => $value) {
        if (!isset($value) || trim($value) == '') {
            $erros .= "_$key=$key Invalido&";
        }
    }

    if ($erros == "") {
        //TODO: Verificar como pegar o $conexao do arquivo database.php
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_insert($conexao, 'cliente', $dados);

        if ($response) {
            header("Location: http://localhost/criarCliente.php?sucesso=true", true, 301);
            exit();
        } else {
            header("Location: http://localhost/criarCliente.php?sucesso=false&_reponse=$response", true, 301);
            exit();
        }
    } else {
        header("Location: http://localhost/criarCliente.php?sucesso=false&$erros", true, 301);
        exit();
    }
}

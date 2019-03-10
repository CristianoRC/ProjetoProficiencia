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
            header("Location: http://localhost/clientes.php?sucesso=true", true, 301);
            exit();
        } else {
            //TODO: Ele não está caindo aqui, apenas da uma mensagem na tela;
            header("Location: http://localhost/criarCliente.php?_reponse=$response", true, 301);
            exit();
        }
    } else {
        header("Location: http://localhost/criarCliente.php?$erros", true, 301);
        exit();
    }
}

function listarUsuario()
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_query($conexao, "select * from cliente");

    if ($response) {
        return pg_fetch_all($response);
    } else {
        return array();
    }

}

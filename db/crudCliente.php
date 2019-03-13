<?php
if (isset($_REQUEST)) {
    if ($_REQUEST['method'] == 'post') {
        cadastrar();
    }
    if ($_REQUEST['method'] == 'delete') {
        if (isset($_REQUEST['cpf'])) {
            deletar($_REQUEST['cpf']);
        } else {
            header("Location: http://localhost/clientes.php?sucesso=false&mensagem=Não foi possível deletar o usuário!", true, 301);
            exit();
        }
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
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_insert($conexao, 'cliente', $dados);

        if ($response) {
            header("Location: http://localhost/clientes.php?sucesso=true&mensagem=Usuário criado com sucesso!", true, 301);
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
        return null;
    }

}

function deletar($cpf)
{
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $cliente = array('cpf' => $cpf);

    $response = pg_delete($conexao, 'cliente', $cliente);
    if ($response) {
        header("Location: http://localhost/clientes.php?sucesso=true&mensagem=Usuário deletado com sucesso!", true, 301);
        exit();
    }
}

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

    preg_match("/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/", $placa, $mathesCPF);
    if (count($mathesCPF) == 0) {
        $erros .= "_cpfFormato=CPF com formato Invalido&";
    }

    preg_match("/^\([1-9]{2}\) (?:[2-8]|9[1-9])[0-9]{3}\-[0-9]{4}$/", $telefone, $mathesTelefone);
    if (count($mathesTelefone) == 0) {
        $erros .= "_telefoneFormato=Telefone com formato Invalido&";
    }

    if ($erros == "") {
        $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
        $response = pg_insert($conexao, 'cliente', $dados);

        if ($response) {
            header("Location: http://localhost/clientes.php?sucesso=true&mensagem=Usuário criado com sucesso!", true, 301);
            exit();
        } else {
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
    $response = pg_query($conexao, "select cpf, nome, email, telefone from cliente where deletado = false");

    if ($response) {
        return pg_fetch_all($response);
    } else {
        return null;
    }

}

function deletar($cpf)
{
    //Se o cliente estiver com algum veículo alugado, ele não podera ser excluído
    $conexao = pg_connect("host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019");
    $response = pg_update($conexao, 'cliente', array('deletado' => 't'), array('cpf' => $cpf));

    if ($response) {
        header("Location: http://localhost/clientes.php?sucesso=true&mensagem=Usuário deletado com sucesso!", true, 301);
        exit();
    }
}

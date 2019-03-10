<?php
$_connectionString = "host=172.17.0.2 port=5432 dbname=locadora user=locadora password=lpw@2019";
$conexao = pg_connect($_connectionString);

if (!$conexao) {
    die("<h1 class='text-danger'>Erro ao conectar ao banco!</h1><br>" . pg_last_error($conexao));
}

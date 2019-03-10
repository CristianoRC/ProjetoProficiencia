<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Locadora de veículos">
  <meta name="author" content="Cristiano Raffi Cunha">
  <title>Locadora - LPW</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="/images/car.png"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <?php require("tools/notificacao.php"); ?>
  <?php
    //TODO: Retornar esses calores do arquivo de Crud
    $nome="";
    $cpf="";
    $email="";
    $telefone="";

    if(isset($_REQUEST['valoresValidos']))
    {
      $nome = $_REQUEST['valoresValidos']['nome'];
      $cpf = $_REQUEST['valoresValidos']['cpf'];
      $email = $_REQUEST['valoresValidos']['email'];
      $telefone = $_REQUEST['valoresValidos']['telefone'];
    }
  ?>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Locadora de veículos</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="clientes.php">Clientes</a>
            <span class="sr-only">(current)</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="veiculos.php">Veículos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="locacoes.php">Locações</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <?php require "db/crudCliente.php"; ?>
        <h3 class="mt-5 mb-3"></i> Novo Cliente</h3>
        <form action="db/crudCliente.php?method=post" method="post">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputNome">Nome</label>
            <input value="<? echo $nome?>" type="text" id="InputNome" class="form-control col-sm-10" placeholder="Nome Sobrenome" name="nome">
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputCpf">CPF</label>
            <input value="<? echo $cpf?>" type="text" id="InputCpf" class="form-control col-sm-10" placeholder="000.000.000-00" name="cpf">
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputEmail">Email</label>
            <input value="<? echo $email?>" type="email" id="InputEmail" class="form-control col-sm-10" aria-describedby="emailHelp" placeholder="user@email.com" name="email">
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputPhone">Telefone</label>
            <input value="<? echo $telefone?>" type="tel" id="InputPhone" class="form-control col-sm-10" placeholder="(00) 00000-0000" name="telefone">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-outline-success float-right"><i class="fas fa-user-plus mr-1"></i> Criar novo usuário</button>
          </div>
          <div class="form-group row ml-3">
            <?php
              if(isset($_REQUEST) > 0)
              {
                $erros = array();
                foreach ($_REQUEST as $key => $value) {
                  if(strpos($key,'_') !== false){
                    array_push($erros,$value);
                  }
                }
                if(count($erros) > 0)
                {
                  echo "<p>Erros:</p>";
                  echo "<ul>";
                  foreach ($erros as $value) { 
                    echo "<li class=\"text-danger\">$value</li>";
                  }
                  echo "</ul>";
                } 
              }
            ?>
          </div> 
        </form> 
      </div>
  </div>
  
  <div class="container">
    <div class="row mt-2">
      <div class="col-lg-5 offset-lg-5">
        <?
          if(isset($_REQUEST['sucesso']) && $_REQUEST['sucesso'] == 'false')
          printarAlerta('Ocorreu um erro ao criar o usuário!','danger');
        ?> 
      </div>
    </div> 
  </div>

  <footer class="footer mt-auto bg-dark py-1 fixed-bottom">
  <div class="container text-white">
    Projeto LPW -
    <a href="https://github.com/cristianorc/" style="text-decoration: none;color:inherit;" target="_blank">@CristianoRC</a>
  </div>
</footer>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

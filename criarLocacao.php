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
  
  <?php 
      require "tools/notificacao.php";
      require 'db/crudCliente.php';
      require 'db/crudVeiculo.php'
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
            <a class="nav-link" href="clientes.php">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="veiculos.php">Veículos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="locacoes.php">Locações</a>
            <span class="sr-only">(current)</span>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <h3 class="mt-5 mb-3"></i> Nova locação</h3>
        <form action="db/crudLocacoes.php?method=post" method="post">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputNome">Cliente</label>
            <select id="InputNome" class="form-control col-sm-10" name="cliente">
            <?php
              $users = listarUsuario(); 
              foreach ($users as $key => $value) {
                $cpf =  $value['cpf'];
                $nome = $value['nome'];
                echo("<option value='$cpf'> $nome - $cpf</option>");
              }
            ?>
            </select>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputVeiculo">Veículo</label>
            <select id="InputVeiculo" class="form-control col-sm-10" name="veiculo">
            <?php
              $veiculos = listarVeiculos('Disponível'); 
              foreach ($veiculos as $key => $value) {
                $placa =  $value['placa'];
                $modelo = $value['modelo'];
                $marca = $value['marca'];
                echo("<option value='$placa'> $marca $modelo - $placa</option>");
              }
            ?>
            </select>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputDate">Data inicial</label>
            <input type="date" id="InputDate" class="form-control col-sm-10" placeholder="(00) 00000-0000" name="dataInicial">
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputDate2">Data Final</label>
            <input type="date" id="InputDate2" class="form-control col-sm-10" placeholder="(00) 00000-0000" name="dataFinal">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-outline-success float-right"><i class="fas fa-money-check-alt mr-1"></i> Cadastrar locação</button>
          </div>
          <div class="form-group row ml-3">
            <?php
              if(isset($_REQUEST))
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

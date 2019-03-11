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
            <a class="nav-link active" href="veiculos.php">Veículos</a>
            <span class="sr-only">(current)</span>
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
        <?php require "db/crudVeiculo.php"; ?>
        <div class="row">
          <div class="col"><h3 class="mt-2 mb-3"></i> Novo Veículo</h3></div>
          <div class="col"><img width="100" id="img-marca" src="https://static.kbb.com.br/Themes/GPS/Images/pt_BR/Brands/AUDI.png" class="rounded float-right" alt="Logo da marca"></div>
        </div>
        <form action="db/crudVeiculo.php?method=post" method="post">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputPlaca">Placa</label>
            <input type="text" id="InputPlaca" class="form-control col-sm-10" placeholder="ABC-0000" name="placa">
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputMarca">Marca</label>
            <select onchange="mudarMarca()" id="selectMarca" class="form-control col-sm-10" id="InputMarca" name="marca">
              <option>Audi</option>
              <option>BMW</option>
              <option>Chevrolet</option>
              <option>Citroen</option>
              <option>Fiat</option>
              <option>Ford</option>
              <option>Honda</option>
              <option>Hyundai</option>
              <option>Jeep</option>
              <option>Mercedes-Benz</option>
              <option>Mitsubishi</option>
              <option>Nissan</option>
              <option>Peugeot</option>
              <option>Renault</option>
              <option>Peugeot</option>
              <option>Volkswagen</option>
            </select>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputModelo">Modelo</label>
            <input type="text" id="InputModelo" class="form-control col-sm-10" placeholder="Ex. A3" name="modelo">
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputCor">Cor</label>
            <select class="form-control col-sm-10" id="InputCor" name="cor">
              <option>Branco</option>
              <option>Preto</option>
              <option>Prata</option>
              <option>Vermelho</option>
              <option>Azul</option>
            </select>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="InputDiaria">Diária(R$)</label>
            <input type="number" id="InputDiaria" class="form-control col-sm-10" placeholder="R$ 250" name="diaria">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-outline-success float-right"><i class="fas fa-car mr-1"></i> Criar novo veículo</button>
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
          printarAlerta('Ocorreu um erro ao criar o veículo!','danger');
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
  <script>
      function mudarMarca()
      {
        let urlPadrao = "https://static.kbb.com.br/Themes/GPS/Images/pt_BR/Brands/@marca.png"         
        let img = document.getElementById("img-marca");
        let marca = document.getElementById("selectMarca");
        let novaUrl = urlPadrao.replace("@marca", marca.value.toUpperCase());
        img.src= novaUrl;
      }
  </script>
</body>

</html>

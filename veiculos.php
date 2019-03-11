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

  <!-- Requires PHP -->
  <?php 
    include 'tools/tabela.php';
    include 'tools/notificacao.php';
    include 'db/crudVeiculo.php'
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
          <li class="nav-item active">
            <a class="nav-link" href="veiculos.php">Veículos</a>
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
      <div class="col-lg-12 text-center">
        <h3 class="mt-5">Veiculos</h3>
        <a href="criarVeiculo.php" class="btn btn-sm btn-outline-success mt-2 mb-5"><i class="fas fa-car mr-3"></i>Adicionar novo veículo</a>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label" for="InputStatus">Filtro</label>
            <select onchange="filtrar()" id="selectStatus" class="form-control col-sm-3" id="InputStatus">
              <option>Ambos</option>
              <option>Disponível</option>
              <option>Indisponível</option>
            </select>
        </div>
        <?php
            $queryResult = listarVeiculos($_REQUEST['status']);

            $headers = array(
              'Placa',
              'Marca',
              'Modelo',
              'Cor',
              'Diária',
              'Status',
              '',
            );
          
            if($queryResult != null)
            {
              $conteudo = array();
              foreach ($queryResult as $key => $value) {
                  $value['disponivel'] = $value['disponivel'] == 't' ? 'Disponível': 'Indisponível';
                  
                  $nomeDaMarcaNormalziado = strtoupper($value['marca']);
                  $value['marca'] = "<img width=\"55\" id=\"img-marca\" src=\"https://static.kbb.com.br/Themes/GPS/Images/pt_BR/Brands/$nomeDaMarcaNormalziado.png\" class=\"rounded\" alt=\"Logo da marca\">";
                  
                  $opcoes ="<a class='btn btn-md' href='db/crudVeiculo.php?method=delete&placa=$value[placa]' style='background-color:transparent;'>
                            <i class=\"fas fa-trash-alt text-danger\"></i></a>";
                  $value['opcoes'] = $opcoes;
                  
                  array_push($conteudo,$value);
              }
  
              printarTabela($headers, $conteudo);
            }
            else
            {
              printarTabela($headers, null);
            }

            //alertas
            if(isset($_REQUEST['sucesso']))
            {
              if($_REQUEST['sucesso'] == 'true')
              printarAlerta($_REQUEST['mensagem'],'success');
              else
              printarAlerta($_REQUEST['mensagem'],'danger');
            }
              
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
      function filtrar(){
        let selectValue = document.getElementById('selectStatus').value;
        if(selectValue === 'Ambos')
        {
          window.location.href="veiculos.php",true;
        }            
        else
        {
          let newUrl="veiculos.php?status=" + selectValue;
          window.location.href=newUrl;
        }
      }

      window.onload = ()=> {
        let selectStatus = document.getElementById('selectStatus');
        
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        
        if(status)
          selectStatus.value = status;
      }
  </script>
</body>

</html>

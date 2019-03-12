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
    include 'db/crudLocacoes.php'
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
          <li class="nav-item active">
            <a class="nav-link" href="locacoes.php">Locações</a>
            <span class="sr-only">(current)</span>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h3 class="mt-5">Locações</h3>
        <a href="criarLocacao.php" class="btn btn-sm btn-outline-success mt-2 mb-5"><i class="fas fas fa-exchange-alt mr-3"></i>Adicionar nova locação</a>
        <?php
            $queryResult = listarLocacoes();

            $headers = array(
              '#',
              'Veiculo',
              'Cliente',
              'Entrega',
              'Devolução',
              'Devolver'
            );
            
            if($queryResult != null)
            {
              //TODO: Valdiar se já foi devolvido para esconder o icone
              $conteudo = array();
              foreach ($queryResult as $key => $value) {
                $opcoes ="<a class='btn btn-md' href='db/crudVeiculo.php?method=put&placa=$value[veiculo]&status=t' style='background-color:transparent;'>
                <i class=\"fas fa-undo-alt text-info\"></i></a>";
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
</body>

</html>

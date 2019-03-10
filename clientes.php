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
  <?php include 'tabela.php';?>
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
            <a class="nav-link active" href="#">Clientes</a>
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
      <div class="col-lg-12 text-center">
        <h3 class="mt-5 mb-3">Clientes</h3>
        <a href="criarCliente.php" class="btn btn-sm btn-outline-success mb-3"><i class="fas fa-user-plus mr-3"></i>Adicionar novo cliente</a>
        <?php
            $headers = array(
                'id' => '#',
                'nome' => 'Nome',
                'sobrenome' => 'Sobrenome',
                'idade' => 'idade',
                'acoes' => '',
            );

            $conteudo = array(array(1, 'A', 'B', 'C', ''), array(2, 'A', 'B', 'C', ''), array(3, 'A', 'B', 'C', ''));
            printarTabela($headers, $conteudo);
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


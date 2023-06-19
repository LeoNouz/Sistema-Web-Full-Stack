<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pedido Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../../static/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <?php
      include "../../static/include/body-svg.html";
      include "../../static/include/body-header-pedido.html";
      include "../../static/include/testa_banco.php";

      $cpf = $_POST['cpf'];

      $sql = "SELECT cpf FROM tb_Cliente WHERE cpf = '$cpf'";

      $result = mysqli_query($con, $sql);
      if ($result === false) 
      {
        $mensagem = "Erro ao executar a consulta: " . mysqli_error($con);
      } 
      else 
      {
        $num_linhas = mysqli_num_rows($result);
        for ($i = 0; $i < $num_linhas; $i++) 
        {
          $dados = mysqli_fetch_row($result);
          $cpf = $dados[0];
        }
        $mensagem = "Consulta concluída com sucesso.";
      }
      mysqli_close($con);
    ?>

    <div class="container">
      <main>
        <div class="row g-5">
          <div class="col-md-7 col-lg-8">
            <form action="cadastrar_novo.php" method="post">
              <div class="row g-3">
                <div class="col-12">
                  <label for="data_pedido" class="form-label">Data do pedido</label>
                  <input type="date" class="form-control" id="data_pedido" name="data_pedido" value="">
                </div>
              </div>

              <hr class="my-4">

              <input type="hidden" id="cpf" name="cpf" value="<?php echo $cpf ?>">
              <button class="w-100 btn btn-primary btn-lg" type="submit">Seguir</button>

              <hr class="my-4">
            </form>
          </div>
        </div>
      </main>
    </div>

    <hr class="my-4">

    <main class="container">
      <div class="bg-light p-5 rounded">
        <a class="btn btn-lg btn-primary" href="../view/cadastrar.html" role="button">Realizar nova consulta &raquo;</a>
      </div>
    </main>
  </main>

  <?php
    include "../../static/include/body-footer.html";
  ?>

  <script src="../../static/js/script.js"></script>
</body>
</html>
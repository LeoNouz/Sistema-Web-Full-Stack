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

      $data_pedido = $_POST['data_pedido'];
      $cpf = $_POST['cpf'];

      // Realiza o cadastro do pedido para gerar um id
      $sql = "INSERT INTO tb_Pedido (cliente_cpf, data_pedido) VALUES ('$cpf', '$data_pedido')";
      $result = mysqli_query($con, $sql);
      if ($result == false) 
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      } 
      else 
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      // Seleciona o id do pedido com base no cpf do cliente e na data do pedido.
      $sql = "SELECT id FROM tb_Pedido WHERE cliente_cpf = '$cpf' AND data_pedido = '$data_pedido'";
      $result = mysqli_query($con, $sql);
      if ($result == false) 
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      } 
      else 
      {
        $num_linhas = mysqli_num_rows($result);
        for ($i = 0; $i < $num_linhas; $i++) 
        {
          $dados = mysqli_fetch_row($result);
          $id_pedido = $dados[0];
        }
      }
      mysqli_close($con);
    ?>

    <hr class="my-4">

    <div class="container">
      <main>
        <div class="row g-5">
          <div class="col-md-7 col-lg-8">
            <form action="itens_pedido.php" method="post">
              <div class="row g-3">
              <div class="col-sm-6">
                  <label for="id_produto" class="form-label">ID do produto</label>
                  <input type="text" class="form-control" id="id_produto" name="id_produto" placeholder="" value="" required>
                </div>

                <div class="col-sm-6">
                  <label for="quantidade" class="form-label">Quantidade</label>
                  <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="" value="" required>
                </div>
              </div>

              <hr class="my-4">

              <input type="hidden" class="form-control" id="id_pedido" name="id_pedido" value="<?php echo $id_pedido ?>">
    
              <button class="w-100 btn btn-primary btn-lg" type="submit">Seguir</button>

              <hr class="my-4">
            </form>
          </div>
        </div>
      </main>
    </div>
  </main>

  <?php
    include "../../static/include/body-footer.html";
  ?>

  <script src="../../static/js/script.js"></script>
</body>
</html>
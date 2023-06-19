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

      $n_rastreio = $_POST['n_rastreio'];
      $tipo_entrega = $_POST['tipo_entrega'];
      $data_entrega = $_POST['data_entrega'];
      $frete = $_POST['frete'];

      $id_pedido = $_POST['id_pedido'];
      $id_pagamento = $_POST['id_pagamento'];
      $n_parcelas = $_POST['n_parcelas'];
      $valor_total = $_POST['valor_total'];
      $valor_parcela = $_POST['valor_parcela'];

      $valor_total = $valor_total + $frete;
      $valor_parcela = $valor_total / $n_parcelas;
  
      $sql = "INSERT INTO tb_Entrega (n_rastreio, tipo_entrega, data_entrega, frete) VALUES ('$n_rastreio', '$tipo_entrega', '$data_entrega', '$frete')";
      $result = mysqli_query($con, $sql);
      if ($result == false) 
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      } 
      else
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      $sql = "UPDATE tb_Pagamento SET valor_parcela = $valor_parcela WHERE id = '$id_pagamento'";
      $result = mysqli_query($con, $sql);
      if ($result == false)
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      }
      else
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      $sql = "UPDATE tb_Pedido SET entrega_n_rastreio = '$n_rastreio', valor_total = '$valor_total' WHERE id = '$id_pedido'";
      $result = mysqli_query($con, $sql);
      if ($result == false)
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      }
      else
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      mysqli_close($con);
    ?>
  </main>

  <main class="container">
    <div class="bg-light p-5 rounded">
      <a class="btn btn-lg btn-primary" href="../view/cadastrar.html" role="button">Realizar novo cadastro &raquo;</a>
    </div>
  </main>

  <?php
    include "../../static/include/body-footer.html";
  ?>

  <script src="../../static/js/script.js"></script>
</body>
</html>
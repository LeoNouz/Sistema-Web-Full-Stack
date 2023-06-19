<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pedido Consulta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../../static/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <?php
      include "../../static/include/body-svg.html";
      include "../../static/include/body-header-cliente.html";
      include "../../static/include/testa_banco.php";

      $id_pedido = $_POST['id_pedido'];

      $sql = "SELECT * FROM tb_Pedido WHERE id = '$id_pedido'";
      
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
          $id = $dados[0];
          $entrega_n_rastreio = $dados[1];
          $pagamento_id = $dados[2];
          $cliente_cpf = $dados[3];
          $tipo_pagamento = $dados[4];
          $desconto = $dados[5];
          $valor_total = $dados[6];
          $data_pedido = $dados[7];
        }
        $mensagem = "Consulta concluída com sucesso.";
      }
      mysqli_close($con);
    ?>
  </main>

  <main class="container">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">ID do pedido</th>
            <th scope="col">Nº de Rastreio</th>
            <th scope="col">ID do pagamento</th>
            <th scope="col">CPF</th>
            <th scope="col">Tipo de pagamento</th>
            <th scope="col">Desconto</th>
            <th scope="col">Valor total</th>
            <th scope="col">Data</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $entrega_n_rastreio; ?></td>
            <td><?php echo $pagamento_id; ?></td>
            <td><?php echo $cliente_cpf; ?></td>
            <td><?php echo $tipo_pagamento; ?></td>
            <td><?php echo $desconto; ?></td>
            <td><?php echo $valor_total; ?></td>
            <td><?php echo $data_pedido; ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <hr class="my-4">

    <div class="bg-light p-5 rounded">
      <a class="btn btn-lg btn-primary" href="../view/consultar.html" role="button">Realizar nova consulta &raquo;</a>
    </div>
  </main>

  <?php
    include "../../static/include/body-footer.html";
  ?>
</body>
</html>
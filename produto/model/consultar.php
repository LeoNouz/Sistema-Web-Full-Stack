<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produto Consulta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../../static/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <?php
      include "../../static/include/body-svg.html";
      include "../../static/include/body-header-produto.html";
      include "../../static/include/testa_banco.php";

      $id = $_POST['id'];

      $sql = "SELECT id, produto, valor, descricao, quantidade FROM tb_Produto WHERE id = $id";
      
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
          $produto = $dados[1];
          $valor = $dados[2];
          $descricao = $dados[3];
          $quantidade = $dados[4];
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
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Valor</th>
            <th scope="col">Descrição</th>
            <th scope="col">Quantidade</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $produto; ?></td>
            <td><?php echo $valor; ?></td>
            <td><?php echo $descricao; ?></td>
            <td><?php echo $quantidade; ?></td>
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
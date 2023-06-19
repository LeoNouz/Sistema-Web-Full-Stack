<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cliente Consulta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../../static/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <?php
      include "../../static/include/body-svg.html";
      include "../../static/include/body-header-cliente.html";
      include "../../static/include/testa_banco.php";

      $cpf = $_POST['cpf'];

      $sql = "SELECT cpf, nome, sobrenome, email, celular, logradouro, bairro, cidade, estado, cep FROM tb_Cliente WHERE cpf = $cpf";
      
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
          $nome = $dados[1];
          $sobrenome = $dados[2];
          $email = $dados[3];
          $celular = $dados[4];
          $logradouro = $dados[5];
          $bairro = $dados[6];
          $cidade = $dados[7];
          $estado = $dados[8];
          $cep = $dados[9];
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
            <th scope="col">CPF</th>
            <th scope="col">Nome</th>
            <th scope="col">Sobrenome</th>
            <th scope="col">Email</th>
            <th scope="col">Celular</th>
            <th scope="col">Logradouro</th>
            <th scope="col">Bairro</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
            <th scope="col">CEP</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $cpf; ?></td>
            <td><?php echo $nome; ?></td>
            <td><?php echo $sobrenome; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $celular; ?></td>
            <td><?php echo $logradouro; ?></td>
            <td><?php echo $bairro; ?></td>
            <td><?php echo $cidade; ?></td>
            <td><?php echo $estado; ?></td>
            <td><?php echo $cep; ?></td>
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
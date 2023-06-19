<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cliente Cadastro</title>
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
      $nome = $_POST['nome'];
      $sobrenome = $_POST['sobrenome'];
      $email = $_POST['emaill'];
      $celular = $_POST['celular'];
      $logradouro = $_POST['logradouro'];
      $bairro = $_POST['bairro'];
      $estado = $_POST['estado'];
      $cidade = $_POST['cidade'];
      $cep = $_POST['cep'];

      $sql = "INSERT INTO tb_Cliente (cpf, nome, sobrenome, email, celular, logradouro, bairro, cidade, estado, cep) 
      VALUES ('$cpf', '$nome', '$sobrenome', '$email', '$celular', '$logradouro', '$bairro', '$cidade', '$estado', '$cep')";

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
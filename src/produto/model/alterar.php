<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produto Altera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../../static/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <?php
      include "../../static/include/body-svg.html";
      include "../../static/include/body-header-produto.html";
    
      include "../../static/include/testa_banco.php";

      $produto = $_POST['produto'];

      $sql = "SELECT produto, valor, descricao, quantidade FROM tb_Produto WHERE produto = '$produto'";

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
          $produto = $dados[0];
          $valor = $dados[1];
          $descricao = $dados[2];
          $quantidade = $dados[3];
        }  
        $mensagem = "Consulta concluída com sucesso.";
      }
      mysqli_close($con);
    ?>

<div class="container">
      <main>
        <div class="row g-5">
          <div class="col-md-7 col-lg-8">
            <form action="../model/cadastrar-produto.php" method="post">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="produto" class="form-label">Produto</label>
                  <input type="text" class="form-control" id="produto" name="produto" placeholder="" value="" required>
                </div>
    
                <div class="col-sm-6">
                  <label for="valor" class="form-label">Valor unitário</label>
                  <input type="number" class="form-control" id="valor" name="valor" min="0.00" max="1000000.00" step="0.10" placeholder="" value="" required>
                </div>
    
                <div class="col-12">
                  <label for="descricao" class="form-label">Descrição</label>
                  <input type="text" class="form-control" id="descricao" name="descricao" placeholder="" required>
                </div>

                <div class="col-12">
                  <label for="quantidade" class="form-label">Quantidade</label>
                  <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" step="1" placeholder="" required>
                </div>
    
              <hr class="my-4">

              <input type="hidden" class="form-control" id="valor" name="valor" value="<?php echo $valor ?>">
              <input type="hidden" class="form-control" id="descricao" name="descricao" value="<?php echo $descricao ?>">
              <input type="hidden" class="form-control" id="quantidade" name="quantidade" value="<?php echo $quantidade ?>">
              <input type="hidden" id="produto" name="produto" value="<?php echo $produto ?>">
              <button class="w-100 btn btn-primary btn-lg" type="submit">Concluir alteração</button>

              <hr class="my-4">
            </form>
          </div>
        </div>
      </main>
    </div>

    <hr class="my-4">

    <main class="container">
      <div class="bg-light p-5 rounded">
        <a class="btn btn-lg btn-primary" href="../view/alterar.html" role="button">Realizar nova consulta &raquo;</a>
      </div>
    </main>
  </main>

  <?php
    include "../../static/include/body-footer.html";
  ?>

  <script src="../../static/js/script.js"></script>
</body>
</html>
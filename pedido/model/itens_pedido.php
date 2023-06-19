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

      $id_produto = $_POST['id_produto'];
      $id_pedido = $_POST['id_pedido'];
      $qtd_produtos_pedido = $_POST['quantidade'];

      // Insere os dados do pedido na tabela Itens Pedido.
      $sql = "INSERT INTO tb_Itens_Pedido (produto_id, pedido_id, quantidade) VALUES ('$id_produto', '$id_pedido', '$qtd_produtos_pedido')";
      $result = mysqli_query($con, $sql);
      if ($result == false) 
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      } 
      else 
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      // Seleciona o valor e a quantidade do produto com base no id.
      $sql = "SELECT valor, quantidade FROM tb_Produto WHERE id = '$id_produto'";
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
          $valor = $dados[0];
          $quantidade = $dados[1];
        }
      }

      // Cálculo do valor total e da quantidade de produtos que sobraram no estoque após o pedido.
      $valor_total = $qtd_produtos_pedido * $valor;
      $qtd_produtos_estoque = $quantidade - $qtd_produtos_pedido;

      // Insere o valor total do pedido com base no id.
      $sql = "UPDATE tb_Pedido SET valor_total = '$valor_total' WHERE id = '$id_pedido'";
      $result = mysqli_query($con, $sql);
      if ($result == false) 
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      } 
      else 
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      
      // Atualiza a quantidade de produto no estoque.
      $sql = "UPDATE tb_Produto SET quantidade = '$qtd_produtos_estoque' WHERE id = '$id_produto'";
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
  
    <hr class="my-4">

    <div class="container">
      <main>
        <div class="row g-5">
          <div class="col-md-7 col-lg-8">
            <form action="pagamento.php" method="post">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="id_pagamento" class="form-label">ID do pagamento</label>
                  <input type="text" class="form-control" id="id_pagamento" name="id_pagamento" placeholder="" value="" required>
                </div>

                <div class="col-md-4">
                  <label for="tipo_pagamento" class="form-label">Tipo de pagamento</label>
                  <select class="form-select" id="tipo_pagamento" name="tipo_pagamento" required>
                    <option value="À vista">À vista</option>
                    <option value="Parcelado">Parcelado</option>
                  </select>
                </div>

                <div class="col-sm-6">
                  <label for="n_parcelas" class="form-label">Número de parcelas</label>
                  <input type="number" class="form-control" id="n_parcelas" name="n_parcelas" placeholder="" value="" required>
                  <small>(Pagamento à vista? Digite 1)</small>
                </div>

                <div class="col-sm-6">
                  <label for="desconto" class="form-label">Desconto</label>
                  <input type="number" class="form-control" id="desconto" name="desconto" placeholder="" value="" required>
                </div>
              </div>

              <hr class="my-4">

              <input type="hidden" class="form-control" id="id_pedido" name="id_pedido" value="<?php echo $id_pedido ?>">
              <input type="hidden" class="form-control" id="valor_total" name="valor_total" value="<?php echo $valor_total ?>">
    
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
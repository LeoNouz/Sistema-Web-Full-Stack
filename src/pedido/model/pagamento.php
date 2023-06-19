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

      $id_pagamento = $_POST['id_pagamento'];
      $n_parcelas = $_POST['n_parcelas'];
      $tipo_pagamento = $_POST['tipo_pagamento'];
      $desconto = $_POST['desconto'];

      $id_pedido = $_POST['id_pedido'];
      $valor_total = $_POST['valor_total'];

      $valor_total = $valor_total - $desconto;
      $valor_parcela = $valor_total / $n_parcelas;
  
      $sql = "INSERT INTO tb_Pagamento (id, n_parcelas, valor_parcela) VALUES ('$id_pagamento', '$n_parcelas', '$valor_parcela')";
      $result = mysqli_query($con, $sql);
      if ($result == false) 
      {
        $mensagem = "Erro ao executar o cadastro: " . mysqli_error($con);
      } 
      else 
      {
        $mensagem = "Cadastro concluído com sucesso!";
      }

      $sql = "UPDATE tb_Pedido SET pagamento_id = '$id_pagamento', tipo_pagamento = '$tipo_pagamento', desconto = '$desconto', valor_total = $valor_total WHERE id = '$id_pedido'";
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
            <form action="entrega.php" method="post">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="n_rastreio" class="form-label">Nº de Rastreio</label>
                  <input type="text" class="form-control" id="n_rastreio" name="n_rastreio" placeholder="" value="" required>
                </div>

                <div class="col-md-4">
                  <label for="tipo_entrega" class="form-label">Tipo de entrega</label>
                  <select class="form-select" id="tipo_entrega" name="tipo_entrega" required>
                    <option value="PAC">PAC</option>
                    <option value="SEDEX">SEDEX</option>
                    <option value="SEDEX EXPRESS">SEDEX expresso</option>
                  </select>
                </div>

                <div class="col-sm-6">
                  <label for="data_entrega" class="form-label">Data da entrega</label>
                  <input type="date" class="form-control" id="data_entrega" name="data_entrega" placeholder="" value="" required>
                </div>

                <div class="col-sm-6">
                  <label for="frete" class="form-label">Frete</label>
                  <input type="number" class="form-control" id="frete" name="frete" placeholder="" value="" required>
                </div>
              </div>

              <hr class="my-4">

              <input type="hidden" class="form-control" id="id_pedido" name="id_pedido" value="<?php echo $id_pedido ?>">
              <input type="hidden" class="form-control" id="id_pagamento" name="id_pagamento" value="<?php echo $id_pagamento ?>">
              <input type="hidden" class="form-control" id="n_parcelas" name="n_parcelas" value="<?php echo $n_parcelas ?>">
              <input type="hidden" class="form-control" id="valor_total" name="valor_total" value="<?php echo $valor_total ?>">
              <input type="hidden" class="form-control" id="valor_parcela" name="valor_parcela" value="<?php echo $valor_parcela ?>">
    
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
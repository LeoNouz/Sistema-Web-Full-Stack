<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cliente Altera</title>
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

      $sql = "SELECT cpf, nome, sobrenome FROM tb_Cliente WHERE cpf = '$cpf'";

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
        }  
        $mensagem = "Consulta concluída com sucesso.";
      }
      mysqli_close($con);
    ?>

    <div class="container">
      <main>
        <div class="row g-5">
          <div class="col-md-7 col-lg-8">
            <form action="alterar_novo.php" method="post">
              <div class="row g-3">
                <div class="col-12">
                  <label for="emaill" class="form-label">Email</label>
                  <input type="email" class="form-control" id="emaill" name="emaill" value="">
                </div>

                <div class="col-12">
                  <label for="celular" class="form-label">Celular</label>
                  <input type="tel" class="form-control" id="celular" name="celular" value="">
                </div>

                <div class="col-12">
                  <label for="logradouro" class="form-label">Logradouro</label>
                  <input type="text" class="form-control" id="logradouro" name="logradouro" value="">
                </div>

                <div class="col-12">
                  <label for="bairro" class="form-label">Bairro</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" value="">
                </div>

                <div class="col-md-5">
                  <label for="estado" class="form-label">Estado</label>
                  <select class="form-select" id="estado" name="estado" value="">
                    <option value="">Escolha...</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="cidade" class="form-label">Cidade</label>
                  <select class="form-select" id="cidade" name="cidade" value="">
                    <option value="">Escolha um estado...</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <label for="cep" class="form-label">CEP</label>
                  <input type="text" class="form-control" id="cep" name="cep" value="">
                </div>
              </div>

              <hr class="my-4">

              <input type="hidden" class="form-control" id="nome" name="nome" value="<?php echo $nome ?>">
              <input type="hidden" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $sobrenome ?>">
              <input type="hidden" id="cpf" name="cpf" value="<?php echo $cpf ?>">
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
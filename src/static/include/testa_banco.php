<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "root";
    $banco = "bd_empresarial";
    $con = mysqli_connect($servidor, $usuario, $senha, $banco);

    if($con===false) {
      $conexao = "Não foi possível conectar ao MySQL!" . mysqli_connect_error();
      exit;
    }
    else {
      $conexao = "Conexão Estabelecida!";
    }
?>
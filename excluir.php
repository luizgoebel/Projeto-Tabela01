<?php

include("conexao.php");
session_start();

$jogo = filter_input(INPUT_GET, 'jogo', FILTER_SANITIZE_STRING);

if (!$jogo) {

    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
  <h4 class='alert-heading'>[ERRO]</h4>
  <p>Dados Faltantes</p>
  <hr>
  <p class='mb-0'>Por favor Verificar os dados!</p>
</div>";
    header("Location: index.php");
} else {

    $sql = 'DELETE FROM dados WHERE 1 AND jogo = ' . $jogo;

    mysqli_query($conexao, $sql);
}

header("Location: index.php");
$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>
  <h4 class='alert-heading'>REGISTRO EXCLUÍDO</h4>
  <p>O registro selecionado foi excluído com SUCESSO!</p>
  <hr>
  <p class='mb-0'>Esta ação de exclusão não pode ser desfeita</p>
</div>";
?>



<?php

    include("conexao.php");
 session_start();
    

    //importação dos registros sql
    $jogo   = filter_input(INPUT_POST, 'jogo', FILTER_SANITIZE_STRING);
    $placar = filter_input(INPUT_POST, 'placar', FILTER_SANITIZE_STRING);
    $MinT   = filter_input(INPUT_POST, 'MinT', FILTER_SANITIZE_STRING);
    $MaxT   = filter_input(INPUT_POST, 'MaxT', FILTER_SANITIZE_STRING);
    $QrMin  = filter_input(INPUT_POST, 'QrMin', FILTER_SANITIZE_STRING);
    $QrMax  = filter_input(INPUT_POST, 'QrMax', FILTER_SANITIZE_STRING);

    //verificar se todos os dados foram preenchidos
    if (!$placar || !$MinT || !$MaxT || !$QrMin || !$QrMax) {
    $_SESSION['msg'] = 'Dados faltantes.';
    }
    //se faltar dados recebe msg erro
    if (!$mensagemErro) {

            $queryNotIsRecord = 'SELECT * FROM dados WHERE QrMax > '.$QrMax.' LIMIT 1';
            $prepara = mysqli_query($conexao, $queryNotIsRecord);
            $isRecord = mysqli_num_rows($prepara) == 0 ? 1 : 0;

        if ($jogo) {

           

            //tratar os dados do editar update
        $inserir = "UPDATE dados SET placar = '$placar', MinT = '$MinT', MaxT = '$MaxT', QrMin = '$QrMin', QrMax = '$QrMax', isRecord = $isRecord WHERE jogo = '$jogo'";
        mysqli_query($conexao, $inserir) or die('erro: '.mysqli_error($conexao));

        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
  <h4 class='alert-heading'>ATUALIZAÇÃO REALIZADA</h4>
  <p>Jogo Atualizado com Sucesso.</p>
  <hr>
  <p class='mb-0'>Foi efetuado alterações no registro.</p>
</div>";   
         } else {

        
            $inserir = "INSERT INTO dados (placar, MinT, MaxT, QrMin, QrMax, isRecord) VALUES ('$placar', '$MinT', '$MaxT', '$QrMin', '$QrMax', $isRecord)";
            mysqli_query($conexao, $inserir);

        $_SESSION['msg'] = "<div class='alert alert-primary' role='alert'>
  <h4 class='alert-heading'>ADIÇÃO REALIZADA</h4>
  <p>Jogo Adicionado com Sucesso</p>
  <hr>
  <p class='mb-0'>Foi Efetuado adição de registro.</p>
</div>";

        }

    }
    
    

    // TO DO : tratar mensagem para quando for update
if (mysqli_insert_id($conexao) || mysqli_affected_rows($conexao) == 1) {
    header("Location: index.php");
} else {

    if (!$_SESSION['msg'] ) $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
  <h4 class='alert-heading'>ATUALIZAÇÃO REALIZADA</h4>
  <p>Jogo Atualizado com Sucesso.</p>
  <hr>
  <p class='mb-0'>Foi Efetuado a edição do registro.</p>
</div>";

    header("Location: form_jogo.php");
}




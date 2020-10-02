<?php
include("conexao.php");

$jogo = filter_input(INPUT_GET, 'jogo', FILTER_SANITIZE_STRING);

if ($jogo) {

    $consulta   = 'SELECT * FROM dados WHERE 1 AND jogo = ' . $jogo;
    $prepara = mysqli_query($conexao, $consulta);
    $jogo    = mysqli_fetch_assoc($prepara);
}


?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="css//estilização.css">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: white;
            background-image: url(../Projeto-Tabela-de-Jogos/imagens/background.jpg);

        }

        div#Formulario {

            margin-left: 440px;
            padding: 10px;
            background-color: white;
            width: 440px;
            height: 560px;
            margin-top: 13px;

        }

        div#Formulario h1 {
            text-align: center;
            font-family: 'Sansita Swashed', cursive;
        }

        div#Formulario h3 {
            text-align: center;
        }

        button#BtnCad {
            font-size: 15pt;
            padding: 10px;
            font-weight: bold;
            margin-left: 120px;
        }

        button#BtnCad:hover {
            text-decoration: underline;
        }

        button#BtnVolt:hover {
            text-decoration: underline;
        }

        label {
            font-family: 'Sansita Swashed', cursive;
            font-size: 14pt;
            padding: 2px;
        }
    </style>

    <title><?php if (isset($jogo)) {
                print 'Editar';
            } else {
                print 'Cadastrar';
            }  ?> Jogos</title>


</head>

<body>


    <div id="Formulario">
        <h1><?php if (isset($jogo)) {
                print 'Editar';
            } else {
                print 'Cadastrar';
            }  ?> Jogos</h1>
        <h1>Formulário de Dados:</h1><br>
        <form method="POST" action="add_edit.php">


            <input type="hidden" name="jogo" value="<?= $jogo['jogo'] ?>">

            <label>Placar do jogo: </label>
            <input type="number" name="placar" placeholder="Placar..." max="1000" required value="<?= $jogo['placar'] ?>"><br><br>

            <label>Mín. da Temporada: </label>
            <input type="number" name="MinT" placeholder="Mínimo..." max="1000" require value="<?= $jogo['MinT'] ?>"><br><br>

            <label>Máx. da Temporada: </label>
            <input type="number" name="MaxT" placeholder="Máximo..." required value="<?= $jogo['MaxT'] ?>"><br><br>

            <label>Quebra Recorde Mín.: </label>
            <input type="number" name="QrMin" placeholder="Recorde." max="1000" required value="<?= $jogo['QrMin'] ?>"><br><br>

            <label>Quebra Recorde Máx.: </label>
            <input type="number" name="QrMax" placeholder="Recorde." max="1000" required value="<?= $jogo['QrMax'] ?>"><br><br>

            <button id="BtnCad" class="btn btn-primary" type="submit">Cadastrar</button>
            <button id="BtnVolt" onclick="window.location.href='index.php'" class="btn btn-secondary" type="button">Voltar</button>
        </form>
    </div>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

</body>

</html>
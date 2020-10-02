<?php
error_reporting(0); //retirar os warnings
session_start();



include("conexao.php"); //inclusao da conexao sql para o index

$jogo = $_GET['jogo']; //variavel jogo pega jogo da tabela sql

$tabela = "SELECT * FROM dados"; //var tabela efetua a consulta de todos os registros na tabela dados

//se jogo tiver em tabela onde jogo tem jogo
if ($jogo) $tabela .= ' WHERE jogo = ' . $jogo;

//var prepara consulta no sql e tabela senao mata a aplicação
$prepara = mysqli_query($conexao, $tabela) or die(mysqli_error($conexao));
//consulta de informaçao da temporada com informações de minimo e maximo para tabela de recores
$queryInfTemp = 'SELECT MIN(MinT) AS MinT, MAX(MaxT) AS MaxT, MIN(QrMin) AS QrMin, MAX(QrMax) AS QrMax FROM dados';
//var prepara 2 consulta no sql e na consulta da temporada senao mata aplicação
$prepara2 = mysqli_query($conexao, $queryInfTemp) or die(mysqli_error($conexao));
//informação da temporada recebe associação da var prepara2
$infTemp = mysqli_fetch_assoc($prepara2);


$queryInfTemp2 = 'SELECT COUNT(*) AS totalRecord FROM dados WHERE isRecord = 1';
$prepara3      = mysqli_query($conexao, $queryInfTemp2) or die(mysqli_error($conexao));
$infTemp2      = mysqli_fetch_assoc($prepara3);

?>


<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="estilizacao.css">
    <!-- Adicionado links de fontes do google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Domine&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Domine&family=Shadows+Into+Light&display=swap" rel="stylesheet">

    

    <title>Temporada da Maria</title>
</head>

<body>
    <!--Criado uma div class para o cabeçalho -->
    <div class="cabecalho">
        <div class="container-fluid">
            <h1>Tabela Temporada da Maria<h1><br>
                    <h2>Acompanhamento da Temporada<h2>
        </div>
    </div>
    <!--Temos aqui nossa imagem bola que será como uma logo por assim dizer-->
    <div id="imagembola"><img id="bola" src="imagens/bola.png" alt=""></div>

    <!--Botao adicionar jogos criado com bootsrtap -->
    <div id="BtnAdd">
        <a class="btn btn-primary" href="form_jogo.php">Adicionar Jogos</a>
    </div>

    <!-- botao consulta bootstrap-->
    <div class="BtnConsulta">
        <form class="form-inline" method="GET">
            <input class="form-control mr-sm-2" name="jogo" type="search" placeholder="Buscar Jogo" aria-label="Search" value="<?= $jogo ?>">
            <button class="btn btn-primary" type="submit">Consultar</button>

            <!--criamos um php para se jogo for verdadeiro ira mostrar o botao de voltar apos a
        consulta junto com o botao consultar(tutorial curso em video estudonalta) -->
            <?php
            if ($jogo) {

                print '<button onclick="window.location.href=\'index.php\'" class="btn btn-secondary" type="button">Voltar</button>';
            }
            ?>
        </form>
    </div>

    <!--criado uma tabela pelo bootstrap-->
    <table class="table table-hover" border="2">
        <thead id="CabecalhoTbl">
            <tr>
                <td>Jogo</td>
                <td>Placar</td>
                <td>Mínimo da Temporada</td>
                <td>Máximo da Temporada</td>
                <td>Quebra de Recorde Min.</td>
                <td>Quebra de Recorde Máx.</td>
                <td>Ação</td>
            </tr>
        </thead>
        <tbody id="DadosTabela">
            <tr>
                <!--Feito um php enquanyo dado recebe a var prepara-->
                <?php while ($dado = mysqli_fetch_assoc($prepara)) { ?>
            <tr>
                <td><?php echo $dado["jogo"]; ?></td>
                <td><?php echo $dado["placar"]; ?></td>
                <td><?php echo $dado["MinT"]; ?></td>
                <td><?php echo $dado["MaxT"]; ?></td>
                <td><?php echo $dado["QrMin"]; ?></td>
                <td><?php echo $dado["QrMax"]; ?></td>
                <td>
                    <!--criei um btn ação onde contem editar e excluir
                com busca no formulario se for editar e exclusao em excluir tudo fazendo
            consulta pelo sql
        variaveis globais para pegar em qualquer lugar-->
                    <button type="button" class="btn btn-primary"><a id="btnEditar" href="form_jogo.php?jogo=<?php echo $dado["jogo"]; ?>">Editar</a>
                    </button>
                    <button type="button" class="btn btn-danger"><a id="btnDelete" href="excluir.php?jogo=<?php echo $dado["jogo"]; ?>">Excluir</a></button>
                </td>

            </tr>
        <?php } ?>
        </tr>
        </tbody>
    </table>


    <!--Sessao de mensagens-->
    <div id="msg-success"><?php
                            if (isset($_SESSION['msg'])) {
                                echo ($_SESSION['msg']);
                                unset($_SESSION['msg']);
                            }
                            ?>
    </div>
    <!--script para desaparecer com minhas mensagens da session em 3 segundos apos executado ação-->
    <script>
        setTimeout(function() {
            var msg = document.getElementById("msg-success");
            msg.parentNode.removeChild(msg);
        }, 4000);
    </script>


    <br>
    <div id="txtInfo">
        <h3>Informações da Temporada</h3>
    </div>
    <!--tabela de informaçoes de recordes-->
    <table class="table table-sm" border="2">
        <thead>
            <tr>
                <th id="Mint" scope="col">Mínimo da Temporada</th>
                <th id="Maxt" scope="col">Máximo da Temporada</th>
                <th id="QrMin" scope="col">Quebra de Recorde Min.</th>
                <th id="QrMax" scope="col">Quebra de Recorde Máx.</th>
                <th id="QrMax" scope="col">Total quebra de record.</th>
            </tr>
        </thead>
        <!--recebendo as informaçoes pelas variaveis do php-->
        <tbody id="TabelaInfo">
            <tr>
                <td id="tblinfomint"><?= $infTemp['MinT'] ?></td>
                <td id="tblinfomaxt"><?= $infTemp['MaxT'] ?></td>
                <td id="tblinfoqrmin"><?= $infTemp['QrMin'] ?></td>
                <td id="tblinfoqrmax"><?= $infTemp['QrMax'] ?></td>
                <td id="tblinfototal"><?= $infTemp2['totalRecord'] ?></td>

            </tr>
        </tbody>
    </table>




    <!-- Ação para ocultar a div depois de 5 segundos -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                $("#session").fadeOut().empty();
            }, 5000);
        }, false);
    </script>





    <br><br><br><br><br>
    <!--footer rodapé-->
    <footer id="rodape">
        <a href="http://www.publica.inf.br/" target="_blank">Seleção de Talentos Pública</a><br>
        Created by Luiz Eduardo Goebel.<br>
        <a href="https://www.facebook.com/luizeduardo.goebel/" target="_blank">Facebook</a> ||
        <a href="https://www.instagram.com/luizgoebel/" target="_blank">Instagram</a>
        <br>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

</body>

</html>
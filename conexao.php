<?php

    global $conexao;

    $host    = "localhost";
    $usuario = "root";
    $senha   = "";
    $bd      = "tabelaJ";

    $conexao = mysqli_connect($host, $usuario, $senha, $bd);

    if (!$conexao) {
        die("Falha na conexão: (".$mysqli->connect_errno.")".$mysqli->connect_error);
    }

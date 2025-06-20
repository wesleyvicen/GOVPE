<?php
if (!isset($_SESSION)) {
    session_start();
}
include('conexao.php');

// executa a consulta
$sql = "SELECT * FROM sonhos ORDER BY id desc";
$res = mysqli_query($conexao, $sql);

if (!$res) {
    error_log("Erro na consulta SQL: " . mysqli_error($conexao));
    http_response_code(500);
    exit('Erro ao carregar os dados do banco de dados.');
}

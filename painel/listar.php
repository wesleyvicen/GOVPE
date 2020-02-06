<?php
if (!isset($_SESSION)) {
    session_start();
}
include('conexao.php');
// executa a consulta
$sql = "SELECT * FROM sonhos ORDER BY id desc";
$res = mysqli_query($conexao, $sql);

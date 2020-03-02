<?php
if (!isset($_SESSION)) {
    session_start();
}
include('conexao.php');
$sql = "DELETE FROM sonhos WHERE id='$id'";
$res = mysqli_query($conexao, $sql) or die(“Erro ao tentar excluir registro”);
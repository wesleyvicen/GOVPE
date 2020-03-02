<?php
if (!isset($_SESSION)) {
    session_start();
}
include('conexao.php');

$id = mysqli_real_escape_string($conexao, trim($_POST['id']));


$sql = "DELETE FROM sonhos WHERE id='$id'";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_removido'] = true;
}

$conexao->close();

header('Location: excluir.php');
exit;
?>
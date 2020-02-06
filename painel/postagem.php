<?php
session_start();
include('conexao.php');

if(empty($_POST['inputTitulo']) || empty($_POST['inputEndereco'])|| empty($_POST['inputfullthumbnails'])|| empty($_POST['inputfullSize'])|| empty($_POST['inputTitulo'])|| empty($_POST['inputTitulo'])) {
    header('Location: index.php');
    exit();
}
$usuario = mysqli_real_escape_string($conexao, $_POST['inputTitulo']);
$usuario = mysqli_real_escape_string($conexao, $_POST['inputEndereco']);
$usuario = mysqli_real_escape_string($conexao, $_POST['inputfullthumbnails']);
$usuario = mysqli_real_escape_string($conexao, $_POST['inputfullSize']);
$titulo         = (isset($_POST['inputTitulo'])             ?       $_POST['inputTitulo']:'');
$endereco       = (isset($_POST['inputEndereco'])           ?       $_POST['inputEndereco']:'');
$thumbnails     = (isset($_POST['inputfullthumbnails'])     ?       $_POST['inputfullthumbnails']:'');
$fullsize       = (isset($_POST['inputfullSize'])           ?       $_POST['inputfullSize']:'');

        $sql_insert = "INSERT INTO sonhos (titulo, endereco	, thumbnails, fullsize) values ('$titulo', '$endereco', '$thumbnails', '$fullsize');";
        $res = mysqli_query($conexao, $sql_insert);

        $row = mysqli_num_rows($res);
        header('Location: painel.php');
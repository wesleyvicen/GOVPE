<?php
require_once __DIR__ . '/verifica_login.php';
require_post();
$titulo = post_text('inputTitulo');
$endereco = post_text('inputEndereco');
$thumbnails = post_text('inputfullthumbnails');
$fullsize = post_text('inputfullSize');
if ($titulo === '' || $endereco === '' || $thumbnails === '' || $fullsize === ''
    || image_url($thumbnails) === '' || image_url($fullsize) === '') {
    http_response_code(422);
    exit('Preencha título, endereço e os endereços válidos das duas imagens.');
}
require __DIR__ . '/conexao.php';
$stmt = $conexao->prepare('INSERT INTO sonhos (titulo, endereco, thumbnails, fullsize) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $titulo, $endereco, $thumbnails, $fullsize);
$stmt->execute();
redirect('/painel/painel.php');

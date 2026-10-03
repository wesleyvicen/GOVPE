<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/conexao.php';
$res = $conexao->query('SELECT id, titulo, endereco, thumbnails, fullsize FROM sonhos ORDER BY id DESC');
$sonhos = $res->fetch_all(MYSQLI_ASSOC);
$res->free();

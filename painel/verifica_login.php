<?php
require_once __DIR__ . '/../app/bootstrap.php';
if (empty($_SESSION['usuario'])) {
    redirect('/painel/index.php');
}

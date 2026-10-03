<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_post();
$usuario = post_text('usuario');
$senha = post_text('senha');
if ($usuario === '' || $senha === '') {
    $_SESSION['nao_autenticado'] = true;
    redirect('/painel/index.php');
}
require __DIR__ . '/conexao.php';
// Compatível com os hashes MD5 já armazenados; não altera contas existentes.
$stmt = $conexao->prepare('SELECT usuario FROM usuario WHERE usuario = ? AND senha = ?');
$hash = md5($senha);
$stmt->bind_param('ss', $usuario, $hash);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    session_regenerate_id(true);
    $_SESSION['usuario'] = $result->fetch_assoc()['usuario'];
    unset($_SESSION['nao_autenticado'], $_SESSION['csrf_token']);
    redirect('/painel/painel.php');
}
$_SESSION['nao_autenticado'] = true;
redirect('/painel/index.php');

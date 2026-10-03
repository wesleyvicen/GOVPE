<?php
require_once __DIR__ . '/verifica_login.php';
require_post();
$nome = post_text('nome');
$usuario = post_text('usuario');
$senha = post_text('senha');
if ($nome === '' || $usuario === '' || $senha === '') {
    http_response_code(422);
    exit('Preencha nome, usuário e senha.');
}
require __DIR__ . '/conexao.php';
$stmt = $conexao->prepare('SELECT COUNT(*) AS total FROM usuario WHERE usuario = ?');
$stmt->bind_param('s', $usuario);
$stmt->execute();
if ($stmt->get_result()->fetch_assoc()['total'] > 0) {
    $_SESSION['usuario_existe'] = true;
    redirect('/painel/cadastro.php');
}
// Preserva o formato da coluna atual; migração de senhas exige alteração do banco.
$hash = md5($senha);
$stmt = $conexao->prepare('INSERT INTO usuario (nome, usuario, senha, data_cadastro) VALUES (?, ?, ?, NOW())');
$stmt->bind_param('sss', $nome, $usuario, $hash);
$stmt->execute();
$_SESSION['status_cadastro'] = true;
redirect('/painel/cadastro.php');

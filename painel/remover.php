<?php
require_once __DIR__ . '/verifica_login.php';
require_post();
$id = filter_var(post_text('id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false) {
    http_response_code(422);
    exit('Informe um ID válido.');
}
require __DIR__ . '/conexao.php';
$stmt = $conexao->prepare('DELETE FROM sonhos WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$_SESSION['status_removido'] = $stmt->affected_rows > 0;
redirect('/painel/excluir.php');

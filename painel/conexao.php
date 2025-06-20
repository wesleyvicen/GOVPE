<?php
define('HOST', 'wesley-db.mysql.uhserver.com');
define('USUARIO', 'wesley_gov');
define('SENHA', 'Wer@99441494');
define('DB', 'wesley_db');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

if (!$conexao) {
    error_log("Erro na conexão com o banco: " . mysqli_connect_error());
    http_response_code(500);
    exit('Erro interno ao conectar com o banco de dados.');
}

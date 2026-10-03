<?php
require_once __DIR__ . '/../app/bootstrap.php';
define('HOST', getenv('DB_HOST') !== false ? getenv('DB_HOST') : 'wesley-db.mysql.uhserver.com');
define('USUARIO', getenv('DB_USER') !== false ? getenv('DB_USER') : 'wesley_gov');
define('SENHA', getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'Wer@99441494');
define('DB', getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'wesley_db');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conexao = mysqli_init();
$conexao->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
@$conexao->real_connect(HOST, USUARIO, SENHA, DB, (int) (getenv('DB_PORT') ?: 3306));
$conexao->set_charset('utf8mb4');

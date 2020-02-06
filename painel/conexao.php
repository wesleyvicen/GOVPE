<?php
define('HOST', 'wesley-db.mysql.uhserver.com');
define('USUARIO', 'wesley_gov');
define('SENHA', 'Wer@99441494');
define('DB', 'wesley_db');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
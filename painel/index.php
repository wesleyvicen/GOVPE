<?php
require_once __DIR__ . '/../app/bootstrap.php';
?>
<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Entrar no painel GOV</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/style.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

</head><body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="/img/favicon.png" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <?php if (!empty($_SESSION['nao_autenticado'])): ?>
            <p role="alert">Usuário ou senha inválidos.</p>
        <?php unset($_SESSION['nao_autenticado']); endif; ?>
        <form action="login.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= h(csrf_token()) ?>">
            <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuário" required autocomplete="username">
            <input type="password" id="password" class="input is-large" name="senha" placeholder="Senha" required autocomplete="current-password">
            <input type="submit" class="fadeIn fourth" value="Entrar">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="/">Voltar ao site</a>
        </div>

    </div>
</div>
</body></html>

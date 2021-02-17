<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/style.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="https://govpe.com.br/img/favicon.png" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuário">
            <input type="password" id="password" class="input is-large" name="senha" placeholder="Senha">
            <input type="submit" class="fadeIn fourth" value="Entrar">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="https://govpe.com.br">Voltar ao site</a>
        </div>

    </div>
</div>
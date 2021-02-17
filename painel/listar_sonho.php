<?php
if (!isset($_SESSION)) {
    session_start();
}
include('verifica_login.php');
require_once ('../painel/listar.php');
$i = 0;
$f = mysqli_fetch_array($res);
?>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Realize o sonho da casa Própria. | Venha conhecer! Escolha sua casa na planta, ruas pavimentadas, Luz e Água. Parcelas a partir de R$399,00">
    <meta name="author" content="Wesley Vicente">
    <link rel="canonical" href="https://govpe.com.br/" />
    <meta name="baseUrl" content="https://govpe.com.br/">
    <meta name="keywords" content="gov, Construtora, apartamentos, Minha Casa Minha Vida, 2 dorms, 3 dorms, piscina, suites, Paulo, Zona Leste, Litoral, Interior, financiamento, empreendimentos, vicência, vicencia" />

    <title>Construtora GOV : GRUPO OLIVEIRA VASCONCELOS</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'/>

    <!-- Fontes personalizadas -->

    <!-- Plugin CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Stylos personalizados -->
    <link href="css/stylePainel.css" rel="stylesheet">

    <!--Favicon Icon -->
    <link rel="icon" href="./img/favicon.png">


</head>
<body>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link active" href="./painel.php">Olá, <?php echo $_SESSION['usuario'];?></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sonhos</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="./cadastrar_sonho.php">Cadastrar</a>
            <a class="dropdown-item" href="#">Alterar</a>
            <a class="dropdown-item" href="./excluir.php">Excluir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="./listar_sonho.php">Listar</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Modelos</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Cadastrar</a>
            <a class="dropdown-item" href="#">Alterar</a>
            <a class="dropdown-item" href="#">Excluir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Listar</a>
        </div>
    </li>
</ul>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Titulo</th>
        <th scope="col">Fullsize</th>
        <th scope="col">Thumbnails</th>
        <th scope="col">Endereco</th>
    </tr>
    </thead>
    <tbody>
    <?php
do {
    echo " <tr>
                <th>".utf8_encode($f['id'])."</th>
                <th>".utf8_encode($f['titulo'])."</th>
                <th>".utf8_encode($f['fullsize'])."</th>
                <th>".utf8_encode($f['thumbnails'])."</th>
                <th>".utf8_encode($f['endereco'])."</th>";
}while (($f = mysqli_fetch_array($res)));
echo("</tr>")

?>
    </tbody>
</table>
</body>
<script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
<script>
    $(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
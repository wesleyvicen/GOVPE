<?php
require_once __DIR__ . '/verifica_login.php';
require __DIR__ . '/listar.php';
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">


    <!-- Fontes personalizadas -->

    <!-- Plugin CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Stylos personalizados -->
    <link href="css/stylePainel.css" rel="stylesheet">

    <!--Favicon Icon -->
    <link rel="icon" href="/img/favicon.png">


</head>
<body>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link active" href="./painel.php">Olá, <?= h($_SESSION['usuario']) ?></a>
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
        <?php if (empty($sonhos)): ?>
            <tr><td colspan="5">Nenhuma entrega cadastrada.</td></tr>
        <?php else: foreach ($sonhos as $sonho): ?>
            <tr>
                <td class="red"><?= h($sonho['id']) ?></td>
                <td><?= h($sonho['titulo']) ?></td>
                <td><?= h($sonho['fullsize']) ?></td>
                <td><?= h($sonho['thumbnails']) ?></td>
                <td><?= h($sonho['endereco']) ?></td>
            </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>

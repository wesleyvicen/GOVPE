<?php
require_once __DIR__ . '/app/bootstrap.php';
$sonhos = [];
$erroSonhos = false;
try {
    require __DIR__ . '/painel/listar.php';
} catch (mysqli_sql_exception $error) {
    error_log('GOV: banco indisponível ao carregar entregas (código ' . $error->getCode() . ')');
    $erroSonhos = true;
    http_response_code(503);
    header('Retry-After: 60');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="O maior passo da sua vida pode ser aquele que você ainda não deu. Explore oportunidades com parcelas acessíveis e atendimento personalizado no Grupo Oliveira Vasconcelos.">
    <meta name="keywords" content="GOV, Grupo Oliveira Vasconcelos, vendas, parcelas, atendimento personalizado, Vicência, Pernambuco">
    <meta name="author" content="Grupo Oliveira Vasconcelos">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://govpe.com.br/">
    <title>Grupo Oliveira Vasconcelos - Realize Seus Sonhos</title>

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Grupo Oliveira Vasconcelos - Realize Seus Sonhos">
    <meta property="og:description" content="Explore oportunidades com parcelas acessíveis e atendimento personalizado em Vicência, Pernambuco.">
    <meta property="og:image" content="https://govpe.com.br/img/bg1.jpeg">
    <meta property="og:url" content="https://govpe.com.br/">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Grupo Oliveira Vasconcelos - Realize Seus Sonhos">
    <meta name="twitter:description" content="Explore oportunidades com parcelas acessíveis e atendimento personalizado em Vicência, Pernambuco.">
    <meta name="twitter:image" content="https://govpe.com.br/img/bg1.jpeg">

    <!-- CSS e outras dependências -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Lato:400,700,400italic,700italic" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.png">
</head>

<body id="page-top">
<header>
    <?php require __DIR__ . '/paginas/menu.php'; ?>
</header>

<main>
    <!-- Cabeçalho central com Parallax -->
    <section class="call-to-action" style="background-image: url('/img/bg1.jpeg');">
        <div class="container wow fadeIn">
            <div class="row">
                <div class="col-md-10 mx-auto text-center">
                            <span class="quote vertical-align">O maior passo da sua vida pode ser aquele que voc&ecirc; ainda n&atilde;o deu.
                            </span>

                    <hr class="colored">
                    <a class="btn btn-primary js-scroll-trigger" href="#entregas">Veja Mais</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Texto abaixo do cabeçalho -->
    <div id="fone-vendas" class="text-center py-3">
        <strong>CENTRAL DE VENDAS: (81) 9.9543-1081</strong><br>
        <strong>PARCELAS A PARTIR DE R$ 399,99</strong>
    </div>

    <!-- Conteúdo dinâmico -->
    <?php 
        require __DIR__ . '/paginas/sonhos.php';
        require __DIR__ . '/paginas/tour360.php';
        require __DIR__ . '/paginas/duvidas.php';
        require __DIR__ . '/paginas/contato.php';
    ?>
</main>

<?php require __DIR__ . '/paginas/footer.php'; ?>

<!-- Botão de voltar ao topo -->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top" aria-label="Voltar ao topo">
        <i class="fa fa-chevron-up" aria-hidden="true"></i>
    </a>
</div>

<!-- Atendimento via WhatsApp -->
<div class="contato">
    <a data-toggle="popover" data-trigger="hover" 
       data-placement="top" 
       data-content="Tiramos todas as suas dúvidas de forma simplificada e personalizada." 
       title="Entre em contato pelo WhatsApp" 
       href="https://api.whatsapp.com/send?phone=5581995431081&text=Eu%20preciso%20de%20ajuda" 
       target="_blank">
        <img src="/img/whatsapp.png" alt="Ícone do WhatsApp - Atendimento personalizado">
    </a>
</div>

<!-- JavaScript e dependências -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="js/jqBootstrapValidation.js" defer></script>
<script src="js/contact_me.js" defer></script>
<script src="/js/freelancer.js" defer></script>
<script src="js/galery.js" defer></script>
<script src="js/lerMais.js" defer></script>
<script src="js/lerMais2.js" defer></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
</body>
</html>

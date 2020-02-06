<?php
require_once ('painel/listar.php');
require_once ('paginas/header.php');?>

<body id="page-top">
<?php require_once ('paginas/menu.php')?>

<!--Teste-->

<div id="conteudo">

    <!--Cabeçalho central com Paralax-->
    <section class="call-to-action" style="background-image: url('img/bg1.jpeg');">
        <div class="container wow fadeIn">
            <div class="row">
                <div class="col-md-10 mx-auto">
                        <span class="quote">
                            <font class="vertical-align">O maior passo da sua vida pode ser aquele que voc&ecirc; ainda n&atilde;o deu.
                            </font>
                        </span>
                    <hr class="colored">
                    <a class="btn btn-primary js-scroll-trigger" href="#entregas">
                        <font class="vertical-align">
                            <font class="vertical-align">Veja Mais</font>
                        </font>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--Texto em baixo do cabeçalho-->
    <div id="fone-vendas">
        <strong>CENTRAL DE VENDAS: (81) 9.9543-1081 teste</strong>
        <strong class="direita">PARCELAS A PARTIR DE 399,99 </strong>
    </div>
    <?php require_once ('paginas/sonhos.php');
          require_once ('paginas/tour360.php');
          require_once ('paginas/duvidas.php');
          require_once ('paginas/contato.php');
          require_once ('paginas/footer.php')?>


    <!-- Rola para o botão superior (visível apenas em tamanhos de tela pequenos e extra-pequenos) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    <!--Atedimento Personalizado-->
    <div class="contato"><a data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Tiramos todas as suas d&#250;vidas, Atendimento simplificado e pessoal, direto com o dono" title="Entre em contato pelo Whatsapp" href="https://api.whatsapp.com/send?l=pt_br&phone=5581995431081&text=Eu%20preciso%20de%20ajuda" target="_blank"><img src="img/whatsapp.png" alt="Whatsapp"></a></div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/script.js"></script>

    <!-- Galery -->
    <script src="js/galery.js"></script>
    <script src="js/lerMais.js"></script>
    <script src="js/lerMais2.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>




</div>

</body>

</html>

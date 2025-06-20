<!-- Grid Sonhos realizados -->
<div id="entregas">
    <section class="gov">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Sonhos Realizados</h2>
            <hr class="star-dark mb-5">
        </div>
    </section>

    <!-- Sonhos Realizados-->
    <section class="p-0">
        <div class="container-fluid p-0" id="box-toggle">
            <div class="row no-gutters popup-gallery">
                <?php
                if (!isset($res) || !$res) {
                    echo '<p class="text-center text-danger w-100">Erro ao carregar os sonhos realizados.</p>';
                } else {
                    $i = 0;
                    $f = mysqli_fetch_array($res);
                    do {
                        echo '<div class="col-lg-4 col-sm-6">
                                <a class="gov-box" href="'.utf8_encode($f['fullsize']).'">
                                <img class="img-fluid thumb" src="'.utf8_encode($f['thumbnails']).'" alt="Entrega da Casa para '.utf8_encode($f['titulo']).'">
                                <div class="gov-box-caption">
                                    <div class="gov-box-caption-content">
                                        <div class="project-category text-faded">ENTREGA PARA</div>
                                        <div class="project-name">'.utf8_encode($f['titulo']).'</div>
                                        <p><i class="fas fa-map-marker-alt"></i> '.utf8_encode($f['endereco']).'</p>
                                    </div>
                                </div>
                            </a>
                        </div>';
                        $i++;
                    } while (($f = mysqli_fetch_array($res)) && $i <= 5);

                    echo '</div><div class="tgl"><div class="container-fluid p-0"><div class="row no-gutters popup-gallery">';

                    do {
                        echo '<div class="col-lg-4 col-sm-6">
                                <a class="gov-box" href="'.utf8_encode($f['fullsize']).'">
                                <img class="img-fluid thumb" src="'.utf8_encode($f['thumbnails']).'" alt="Entrega da Casa para '.utf8_encode($f['titulo']).'">
                                <div class="gov-box-caption">
                                    <div class="gov-box-caption-content">
                                        <div class="project-category text-faded">ENTREGA PARA</div>
                                        <div class="project-name">'.utf8_encode($f['titulo']).'</div>
                                        <p><i class="fas fa-map-marker-alt"></i> '.utf8_encode($f['endereco']).'</p>
                                    </div>
                                </div>
                            </a>
                        </div>';
                        $i++;
                    } while ($f = mysqli_fetch_array($res));

                    echo '</div></div></div>';
                    mysqli_close($conexao);
                }
                ?>
            </div>
        </div>
    </section>
</div>

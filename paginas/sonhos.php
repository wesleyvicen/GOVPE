<!-- Grid Sonhos realizados -->
<div id="entregas">
    <section class="gov">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Sonhos Realizados</h2>
            <hr class="star-dark mb-5">
        </div>
    </section>
    <section class="p-0">
        <div class="container-fluid p-0" id="box-toggle">
            <?php if (!empty($erroSonhos)): ?>
                <p class="text-center w-100">As entregas estão temporariamente indisponíveis. Tente novamente em instantes.</p>
            <?php elseif (empty($sonhos)): ?>
                <p class="text-center w-100">Em breve, novas entregas por aqui.</p>
            <?php else: ?>
                <?php foreach (array_chunk($sonhos, 6) as $grupo => $itens): ?>
                    <?php if ($grupo === 1): ?><div class="tgl"><?php endif; ?>
                    <div class="row no-gutters popup-gallery">
                        <?php foreach ($itens as $sonho): ?>
                            <div class="col-lg-4 col-sm-6">
                                <a class="gov-box" href="<?= h(image_url($sonho['fullsize'])) ?>">
                                    <img class="img-fluid thumb" loading="lazy" src="<?= h(image_url($sonho['thumbnails'])) ?>" alt="Entrega da Casa para <?= h($sonho['titulo']) ?>">
                                    <div class="gov-box-caption"><div class="gov-box-caption-content">
                                        <div class="project-category text-faded">ENTREGA PARA</div>
                                        <div class="project-name"><?= h($sonho['titulo']) ?></div>
                                        <p><i class="fas fa-map-marker-alt"></i> <?= h($sonho['endereco']) ?></p>
                                    </div></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
                <?php if (count($sonhos) > 6): ?></div><?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</div>

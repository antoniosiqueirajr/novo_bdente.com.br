<!-- section start -->
<section data-anim-wrap class="layout-mt-headerBar h-md md:h-70vh">
    <div data-anim-child="img-right cover-white delay-2" class="bg-fill-image">
        <div data-parallax="0.7" class="h-full overlay-black-sm">
            <div data-parallax-target class="bg-image js-lazy" data-bg="/public/images/Fundos/fundo-benepop_old.jpg"></div>
        </div>
    </div>
</section>
<!-- section end -->


<!-- section start -->
<section class="layout-pt-lg layout-pb-lg">
    <!-- container start -->
    <div class="container">
        <div class="clinicas" id="clinicas">
            <div class="conteudo">
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <h2>
                            <small>Nossas</small>
                            <strong>Unidades</strong>
                        </h2>
                        <p>
                            Encontre a unidade mais<br>próxima de você!
                        </p>
                        <h4>CLIQUE NA UNIDADE</h4>
                        <div class="lista-estados">
                            <div class="owl-carousel owl-theme estados">
                                <?php $x = 0; foreach($estados as $uf=>$nome): $x++; ?>
                                <div class="item item-mapa-clinicas" data-estado="<?php echo strtolower($uf); ?>" data-index-mapa="<?php echo $x; ?>">
                                    <span class="titulo">
                                        <span class="estado"><?php //echo $nome; ?></span>
                                    </span>
                                    <ul class="cidades">
                                        <?php foreach($unidades[$uf] ?? array() as $clinica): ?>
                                        <li><a href="/<?php echo $clinica->link ?>"><?php output($clinica->nome); ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8 offset-1">
                        <?php echo $this->load->view('comum/mapa2'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section end -->


<!-- section start -->
<section data-parallax="0.7" class="layout-pt-lg layout-pb-lg">
    <div data-parallax-target class="overlay-black-md bg-image js-lazy" data-bg="/public/images/Fundos/fundo-idosos.jpg"></div>

    <!-- container start -->
    <div class="container z-5">
        <!-- row start -->
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p class="text-sm uppercase tracking-lg text-white mb-20">
                    Fale conosco!
                </p>

                <h2 class="text-5xl sm:text-5xl xs:text-4xl leading-sm fw-700 text-white">
                    Ficou com alguma dúvida?
                </h2>

                <p class="text-xl md:text-lg text-white mt-16">
                    Converse conosco sem compromisso!
                </p>

                <a href="/fale_conosco" class="button -md -white text-black mt-32">
                    Entrar em contato
                </a>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
<!-- section end -->
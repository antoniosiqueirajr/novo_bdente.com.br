<!-- section start -->
<section data-speed="1200" data-autoplay-delay="100000" class="sliderMain -type-3 js-sliderMain-type-3 sm:layout-mt-headerBar">
    <!-- container start -->
    <div class="container-fluid h-full px-0 sm:px-20">
        <!-- row start -->
        <?php foreach($banners as $banner): ?>
        <div class="row sm:justify-content-center h-full">
            <div class="col-xl-3 offset-xl-2 col-lg-4 offset-lg-1 col-md-5 offset-md-1 col-sm-9">
                <div class="slider__content__wrapper sm:text-center h-full z-3">
                    <div class="slider__content  is-active  js-slider-content">
                        <div data-split="lines">
                            <p class="slider__subtitle text-sm uppercase tracking-md leading-md mb-32 js-subtitle">
                                <?php output($banner->subtitulo); ?>
                            </p>
                        </div>
                        <div data-split="lines" class="mr-minus-col-2 sm:mr-0">
                            <h1 class="slider__title fw-700 leading-xs js-title">
                                <?php output($banner->titulo); ?>
                            </h1>
                        </div>
                        <div class="slider__button overflow-hidden mt-32">
                            <div class="js-button py-4">
                                <a href="<?php echo $banner->botao_acao; ?>" class="button -md-black text-danger">
                                    <?php output($banner->botao_label); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col layout-pr-headerBar lg:pr-0 col-lg-7 col-md-6 swiper-col"></div>
        </div>
        <?php endforeach; ?>
        <?php foreach($banners as $banner): ?>
        <div class="row sm:justify-content-center h-full banner-background">
            <div class="col col-sm-12 swiper-col">
                <div class="swiper-container h-100vh">
                    <div class="swiper-wrapper z-2">
                        <div class="swiper-slide overflow-hidden">
                            <div class="slider__img" data-swiper-parallax="150" data-parallax="0.7" data-swiper-parallax-opacity="0">
                                <div data-parallax-target class="bg-image swiper-lazy js-image" data-background="<?php echo $banner->imagem; ?>"></div>
                            </div>
                            <div class="slider__img__cover js-image-cover"></div>
                            <div class="slider__img__bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- row end -->
        <!-- slider nav start -->
        <div class="slider__navs js-slider-nav js-ui">
            <div class="navButton">
                <button type="button" class="navButton__item button -outline-black text-black js-prev">
                    <i class="icon" data-feather="arrow-left"></i>
                </button>
                <button type="button" class="navButton__item button -outline-black text-black mt-12 js-next">
                    <i class="icon" data-feather="arrow-right"></i>
                </button>
            </div>
        </div>
        <!-- slider nav end -->
    </div>
    <!-- container end -->
    <!-- ui-element start -->
    <div class="ui-element -bottom-left sm:d-none js-ui">
        <button type="button" class="ui-element__scroll text-black js-ui-scroll-button">
            Saiba mais
            <i class="icon" data-feather="arrow-down"></i>
        </button>
    </div>
    <!-- ui-element end -->
</section>
<!-- section end -->
<?php echo form_open('formulario_agenda', 'id="agenda-avaliacao" class="form-avaliation"'); ?>
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="text-uppercase">Agende Agora <br> sua avaliação</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="w-100 label-float">
                <input class="form-control" placeholder=" " id="name" name="nome" type="text" required>
                <label for="name">Nome</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="w-100 label-float">
                <input class="mascara-telefone" placeholder=" " id="phone" name="telefone" type="tel" required>
                <label for="phone">Tefone</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="w-100 label-float">
                <input class="form-control" placeholder=" " id="name" name="dia" type="text" required>
                <label for="dia">Qual o melhor dia?</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="w-100 label-float">
                <select class="form-control" id="estado" name="periodo" required>
                    <option selected="selected" value="">Qual melhor Período?</option>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option></select>
                </select>
            </div>
        </div>
    </div>
   

  
    <div class="row">
        <div class="col-12">
            <div class="w-100 label-float">
                <select class="form-control" id="cidade" name="unidade" required>
                    <option value="">Selecione a Unidade</option>
                    <?php foreach($unidades as $estado=>$cidades): ?>
                    <?php foreach($cidades as $unidade): ?>
                    <option value="<?php echo $unidade->id; ?>"><?php output($unidade->nome) ?></option>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary" style="font-size: 16px;">
                <i class="icon-calendar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21">
                        <path fill-rule="evenodd" fill="#FFF"
                              d="M18.959 20.999H2.7a1.834 1.834 0 0 1-1.825-1.836V4.724c0-.99.799-1.795 1.772-1.824v2.463c0 1.114.903 2.011 2.016 2.011h1.272a2.022 2.022 0 0 0 2.028-2.011V2.891h5.732v2.472c0 1.114.915 2.011 2.029 2.011h1.271a2.012 2.012 0 0 0 2.016-2.011V2.9a1.833 1.833 0 0 1 1.772 1.824v14.439a1.835 1.835 0 0 1-1.824 1.836zm-.538-10.193a.79.79 0 0 0-.789-.79H3.992a.79.79 0 0 0-.789.79v7.458c0 .436.353.789.789.789h13.64a.789.789 0 0 0 .789-.789v-7.458zm-2.755 7.17h-1.613a.462.462 0 0 1-.462-.463v-1.612c0-.256.207-.462.462-.462h1.613c.255 0 .462.206.462.462v1.612a.462.462 0 0 1-.462.463zm0-4.032h-1.613a.462.462 0 0 1-.462-.462v-1.614c0-.254.207-.461.462-.461h1.613c.255 0 .462.207.462.461v1.614a.462.462 0 0 1-.462.462zm-4.03 4.032h-1.613a.462.462 0 0 1-.462-.463v-1.612c0-.256.207-.462.462-.462h1.613c.254 0 .461.206.461.462v1.612a.462.462 0 0 1-.461.463zm0-4.032h-1.613a.462.462 0 0 1-.462-.462v-1.614c0-.254.207-.461.462-.461h1.613c.254 0 .461.207.461.461v1.614a.462.462 0 0 1-.461.462zm-4.031 4.032H5.992a.462.462 0 0 1-.461-.463v-1.612a.46.46 0 0 1 .461-.462h1.613c.255 0 .462.206.462.462v1.612a.462.462 0 0 1-.462.463zm0-4.032H5.992a.461.461 0 0 1-.461-.462v-1.614c0-.254.206-.461.461-.461h1.613c.255 0 .462.207.462.461v1.614a.462.462 0 0 1-.462.462zm9.36-7.89h-1.258a.691.691 0 0 1-.691-.691v-4.04c0-.381.31-.691.691-.691h1.258c.382 0 .692.31.692.691v4.04c0 .382-.31.691-.692.691zm-11.048 0H4.659a.691.691 0 0 1-.692-.691v-4.04c0-.381.31-.691.692-.691h1.258c.381 0 .691.31.691.691v4.04c0 .382-.31.691-.691.691z"/>
                    </svg>
                </i>
                Solicitar Agendamento
            </button>
        </div>
    </div>
<?php echo form_close(); ?>

<section class="layout-pt-xl layout-pb-xl">
    <!-- container start -->
    <div class="container">
        <!-- row start -->
        <div class="row">
            <div class="col-xl-5 col-lg-8 col-md-10">
                <div class="sectionHeading -lg">
                    <!-- <p class="sectionHeading__subtitle"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        empresa
                        </font></font></p> -->
                    <h2 class="sectionHeading__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        <?php output($empresa->chamada_home); ?>
                        </font></font></h2>
                </div>
            </div>
        </div>
        <!-- row end -->
        <!-- row start -->
        <div class="row x-gap-60 y-gap-48 layout-pt-md">
            <div class="col-lg-4 col-md-6">
                <div class="">
                    <h4 class="text-xl fw-600"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Nossa Missão
                        </font></font></h4>
                    <p class="mt-16"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        <?php output($empresa->missao); ?>
                        </font></font></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="">
                    <h4 class="text-xl fw-600"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Nosso Objetivo
                        </font></font></h4>
                    <p class="mt-16"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        <?php output($empresa->objetivos); ?>
                        </font></font></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="">
                    <h4 class="text-xl fw-600"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Nosso Atendimento
                        </font></font></h4>
                    <p class="mt-16"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        <?php output($empresa->exposicoes); ?>
                        </font></font></p>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
<!-- section start -->
<section class="layout-pt-xs layout-pb-md">
    <!-- row start -->
    <div class="fancy-grid -col-3 -container">
        <?php foreach($tratamentos as $tratamento): ?>
        <div class="fancy-grid__item">
            <a data-anim-wrap class="portfolioCard -type-1 -hover" data-barba href="#">
                <div class="portfolioCard__img">
                    <div data-anim-child="img-right -cover-dark-1" class="portfolioCard__img__inner">
                        <div class="ratio ratio-3:4 bg-image js-lazy" data-bg="<?php echo $tratamento->imagem ?>"></div>
                    </div>
                </div>
                <div class="portfolioCard__content pt-16">
                    <div data-split="lines" data-anim-child="split-lines delay-8">
                        <h3 class="portfolioCard__title leading-md fw-500 text-2xl mt-8">
                            <?php output($tratamento->nome); ?>
                        </h3>
                    </div><br>
                    <div data-split="lines" data-anim-child="split-lines delay-6">
                        <p class="portfolioCard__category leading-md text-dark">
                            <?php output($tratamento->descricao1); ?>
                        </p>
                    </div><br>
                    <div data-split="lines" data-anim-child="split-lines delay-6">
                        <p class="portfolioCard__category leading-md text-dark">
                            <?php output($tratamento->descricao2); ?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- row end -->
</section>
<!-- section end -->
<!-- section start -->
<section class="layout-pt-md layout-pb-md">
    <!-- container start -->
    <div class="container">
        <!-- row start -->
        <div class="row">
            <div class="col-xl-5 col-lg-8 col-md-10">
                <div class="sectionHeading -lg">
                    <!-- <p class="sectionHeading__subtitle">
                        Serviços
                    </p> -->
                    <h2 class="sectionHeading__title">
                        O que fazemos por você
                    </h2>
                </div>
            </div>
        </div>
        <!-- row end -->
        <!-- row start -->
        <div data-anim-wrap class="row x-gap-60 y-gap-48 layout-pt-md">
            <?php foreach($servicos as $servico): ?>
            <div class="col-lg-4 col-md-6">
                <div class="serviceCard">
                    <div class="serviceCard__content">
                        <div class="d-flex align-items-center ml-minus-4">
                            <div data-anim-child="img-right cover-dark-2" class="px-20 py-20 bg-white shadow-light rounded-full">
                                <i class="size-md str-width-md text-accent" data-feather="<?php echo $servico->icone; ?>"></i>
                            </div>
                        </div>
                        <h3 class="serviceCard__title text-2xl fw-500 tacking-none mt-32">
                            <?php output($servico->nome); ?>
                        </h3>
                        <p class="serviceCard__text mt-16">
                            <?php output($servico->descricao); ?>
                        </p>
                        <?php if($servico_itens[$servico->id] ?? FALSE): ?>
                        <div class="text-black mt-24">
                            <?php foreach($servico_itens[$servico->id] as $item): ?>
                            <span class="mt-8" style="display: inline-block;padding-right: 5px;white-space: nowrap;"><span style="display: inline-block; height: 5px; width: 5px;background-color: #000;border-radius: 50%;margin-right: 4px;"></span><?php output($item->nome); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
<!-- section end -->
<!-- section start -->
<section class="layout-pt-md layout-pb-md">
    <!-- container start -->
    <div class="container-fluid px-0">
        <!-- row start -->
        <div data-anim-wrap class="row no-gutters align-items-center">
            <div class="col-lg-6 z-1">
                <div data-anim-child="img-right cover-white delay-1">
                    <div class="ratio ratio-1:1" data-parallax="0.7">
                        <div data-parallax-target class="bg-image js-lazy" data-bg="<?php echo $implantes->imagem_home; ?>"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 z-2 ml-80 md:ml-0 md:mt-48">
                <div class="sectionHeading -xl md:container pt-16">
                    <!-- <div data-anim-child="slide-up delay-8">
                        <p class="sectionHeading__subtitle">
                            Implantes Dentários
                        </p>
                    </div> -->
                    <div data-anim-child="slide-up delay-9" class="ml-minus-col-1 lg:ml-minus-lg mr-minus-col-2 md:ml-0 md:mr-0">
                        <h2 class="sectionHeading__title mt-48 md:mt-24">
                            <?php output($implantes->chamada_home); ?>
                        </h2>
                    </div>
                    <div data-anim-child="slide-up delay-10">
                        <p class="mt-56 lg:mt-40 md:mt-20">
                            <?php output($implantes->texto_home); ?>
                        </p>
                    </div>
                    <div data-anim-child="slide-up delay-11">
                        <a data-barba href="/implantes_dentarios" class="button -md -outline-black text-black mt-56 lg:mt-48 md:mt-32">
                            Saiba mais
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
<!-- section end -->
<section class="layout-pt-md layout-pb-lg">
    <!-- container start -->
    <div class="container">
        <!-- row start -->
       
        <!-- row end -->
        <!-- row start -->
        <!-- <div class="row y-gap-32 layout-pt-md">
            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-3:2 border-dark rounded-4 py-4 is-in-view">
                    <div class="clientsItem__img">
                        <img class="col-7" src="/img/clients/dark/1.png" alt="Cliente">
                    </div>
                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-xl text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Sophia e Holden
                            </font></font></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-3:2 border-dark rounded-4 py-4 is-in-view">
                    <div class="clientsItem__img">
                        <img class="col-7" src="/img/clients/dark/2.png" alt="Cliente">
                    </div>
                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-xl text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Sophia e Holden
                            </font></font></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-3:2 border-dark rounded-4 py-4 is-in-view">
                    <div class="clientsItem__img">
                        <img class="col-7" src="/img/clients/dark/3.png" alt="Cliente">
                    </div>
                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-xl text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Sophia e Holden
                            </font></font></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div data-anim="slide-up delay-1" class="clientsItem -hover ratio ratio-3:2 border-dark rounded-4 py-4 is-in-view">
                    <div class="clientsItem__img">
                        <img class="col-7" src="/img/clients/dark/4.png" alt="Cliente">
                    </div>
                    <div class="clientsItem__content">
                        <h5 class="clientsItem__title text-xl text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            Sophia e Holden
                            </font></font></h5>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
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
<!-- section start -->
<section class="layout-pt-xl layout-pb-lg">
    <div data-parallax="0.7" class="bg-fill-image overlay-black-md">
        <div data-parallax-target class="bg-image js-lazy" data-bg="/public/images/Fundos/fundo-idosos.jpg"></div>
    </div>
    <!-- container start -->
    <div class="container">
        <div data-cursor data-cursor-label="DRAG" class="overflow-hidden js-section-slider" data-slider-col="base-1 lg-1 md-1 sm-1" data-pagination data-loop>
            <div class="pagination -light js-pagination pt-4 mb-48"></div>
            <div class="swiper-wrapper">
                <?php foreach($depoimentos as $depoimento): ?>
                <div class="swiper-slide">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="testimonials text-center">
                                <p class="testimonials__comment text-3xl md:text-2xl sm:text-xl fw-600 leading-xl text-white">
                                    <?php output($depoimento->depoimento) ?>
                                </p>
                                <div class="testimonials__author mt-48">
                                    <div class="size-xl mx-auto mb-20">
                                        <div class="bg-image rounded-full swiper-lazy" data-background="<?php echo $depoimento->imagem; ?>"></div>
                                    </div>
                                    <h5 class="text-lg capitalize text-white fw-600"><?php output($depoimento->nome); ?></h5>
                                    <p class="capitalize text-light"><?php output($depoimento->cargo); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- container end -->
</section>
<!-- section end -->
<section class="layout-pt-lg layout-pb-lg">
    <!-- container start -->
    <div class="container">
        <!-- row start -->
        <div class="row justify-content-between align-items-end">
            <div class="col-md-6">
                <div class="sectionHeading -md">
                    <p class="sectionHeading__subtitle"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        nosso diário
                        </font></font></p>
                    <h2 class="sectionHeading__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Últimas notícias
                        </font></font></h2>
                </div>
            </div>
            <div class="col-md-auto col-sm-12 sm:mt-24">
                <a href="/blog" class="button -md -outline-black text-black"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    ver tudo
                    </font></font></a>
            </div>
        </div>
        <!-- row end -->
        <!-- row start -->
        <div class="row x-gap-48 y-gap-40 layout-pt-sm">
            <?php foreach($noticias as $noticia): ?>
            <div class="col-lg-4 col-md-6">
                <div data-anim-wrap="" class="blogCard -type-1 -hover animated">
                    <a class="blogCard__img" data-barba="" href="<?php echo $noticia->permalink ?>">
                        <div data-anim-child="img-right cover-dark-1 delay-1" class="is-in-view">
                            <div class="ratio ratio-4:3 bg-image js-lazy loaded" data-ll-status="loaded" style="background-image: url(<?php echo $noticia->imagem ?>);"></div>
                        </div>
                    </a>
                    <div class="blogCard__content mt-24">
                        <div data-anim-child="slide-up delay-6" class="blogCard__info text-dark leading-md text-sm is-in-view">
                            <a class="fw-400 mr-4" href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo output($noticia->categoria_nome); ?></font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> -
                            </font></font><p class="d-inline-block ml-4"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">28 de maio de 2020</font></font></p>
                        </div>
                        <div data-anim-child="slide-up delay-7" class="is-in-view">
                            <h4 class="blogCard__title text-2xl leading-lg fw-500 mt-12">
                                <a data-barba="" href="/blog/artigo-do-blog"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                    <?php output($noticia->titulo) ?>
                                    </font></font></a>
                            </h4>
                        </div>
                        <div data-anim-child="slide-up delay-8" class="mt-12 is-in-view">
                            <a data-barba="" href="/blog/artigo-do-blog" class="button -icon text-black"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                consulte Mais informação
                                </font></font><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right icon size-xs str-width-md"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
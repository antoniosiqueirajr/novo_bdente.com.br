<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/css/vendors.css">
        <link rel="stylesheet" href="/css/main.css">

        <link rel="stylesheet" href="/vendor/owlcarousel-2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="/vendor/owlcarousel-2.3.4/assets/owl.theme.default.min.css">

        <link rel="stylesheet" href="/css/custom.css">

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

        <title>BenePop Implantes - Realizando Sonho Implantando Sorrisos</title>

        <meta name="adopt-website-id" content="6fa4b631-6e4d-49e7-97d0-6cfae384df32" />


                <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-6L16JYNBSK"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'G-6L16JYNBSK');
            </script>


    </head>

    <body class="preloader-visible" data-barba="wrapper">

        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KFP7QJP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


    


        <!-- preloader start -->
        <div class="preloader js-preloader">
            <div class="preloader__bg"></div>

            <div class="preloader__progress">
                <div class="preloader__progress__inner"></div>
            </div>
        </div>
        <!-- preloader end -->


        <!-- cursor start -->
        <div class="cursor js-cursor">
            <div class="cursor__wrapper">
                <div class="cursor__follower js-follower"></div>
                <div class="cursor__label js-label"></div>
                <div class="cursor__icon js-icon"></div>
            </div>
        </div>
        <!-- cursor end -->


        <!-- barba container start -->
        <div class="barba-container" data-barba="container">

            <!-- to-top-button start -->
            <div data-cursor class="backButton js-backButton">
                <span class="backButton__bg"></span>
                <div class="backButton__icon__wrap">
                    <i class="backButton__button js-top-button" data-feather="arrow-up"></i>
                </div>
            </div>
            <!-- to-top-button end -->


            <main class="">


                <!-- header start -->
                <header class="header -light -sticky-light js-header-light -classic js-header">
                    <!-- header__bar start -->
                    <div class="header__bar">
                        <div class="overflow-hidden">
                            <div class="header__logo js-header-logo">
                                <a data-barba href="/">
                                    <img class="header__logo__light" src="/img/BENEPOP_LOGO_3D.png" alt="logo">
                                </a>
                                <a data-barba href="/">
                                    <img class="header__logo__dark" src="/img/BENEPOP_LOGO_3D.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <?php if($unidade ?? FALSE): ?>
                            <div class="responsavel">
                                Responsável Técnico<br>
                                <?php output($unidade->responsavel); ?> CRM/<?php echo $unidade->cro; ?> | CML <?php echo $unidade->clm; ?>
                            </div>
                        <?php endif; ?>
                        <div class="navClassic-wrap js-header-menu-classic">
                            <ul class="navClassic-list js-navClassic-list">
                                <!-- <li>
                                    <a data-barba href="/">
                                        Home
                                    </a>
                                </li> -->
                                <li>
                                    <a data-barba href="/quem_somos">
                                        A BenePop Implantes
                                    </a>
                                </li>
                                 <li>
                                    <a data-barba href="#">
                                        Tratamentos
                                    </a>
                                </li>
                                <li>
                                    <a data-barba href="/implantes_dentarios">
                                        Implantes Dentários
                                    </a>
                                </li>
                                 <li>
                                    <a data-barba href="/">
                                       Carga Imédiata
                                    </a>
                                </li>
                                <li>
                                    <a href="/unidades">
                                        Unidades
                                    </a>
                                </li>
                                <li>
                                    <a href="/franquia">
                                        Seja um franqueado
                                    </a>
                                </li>

                                <li>
                                    <a data-barba href="/blog">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a data-barba href="/fale_conosco">
                                        Fale Conosco
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="header__menu__wrap overflow-hidden">
                            <div class="header__menu js-header-menu">
                                <button type="button" class="nav-button-open js-nav-open">
                                    <i class="icon" data-feather="menu"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- header__bar end -->


                    <!-- nav start -->
                    <nav class="nav js-nav">
                        <div class="nav__inner js-nav-inner">
                            <div class="nav__bg js-nav-bg"></div>

                            <div class="nav__container">
                                <div class="nav__header">
                                    <button type="button" class="nav-button-back js-nav-back">
                                        <i class="icon" data-feather="arrow-left-circle"></i>
                                    </button>

                                    <button type="button" class="nav-btn-close js-nav-close pointer-events-none">
                                        <i class="icon" data-feather="x"></i>
                                    </button>
                                </div>

                                <div class="nav__content">
                                    <div class="nav__content__left">
                                        <div class="navList__wrap">
                                            <ul class="navList js-navList">
                                                <li>
                                                    <a data-barba href="/">
                                                        Home
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/quem_somos">
                                                        Quem Somos?
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/implantes_dentarios">
                                                        Implantes Dentários
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/unidades">
                                                        Unidades
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/empresario_de_sucesso">
                                                        Empresário de sucesso
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/blog">
                                                        Blog
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/fale_conosco">
                                                        Fale Conosco
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="nav__content__right">
                                        <div class="nav__info">
                                            <div class="nav__info__item js-navInfo-item">
                                                <h5 class="text-sm tracking-none fw-500">
                                                    Endereço
                                                </h5>

                                                <div class="nav__info__content text-lg text-white mt-16">
                                                    <p>
                                                        R. Comendador Macedo, 62<br>Centro, Curitiba - PR
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="nav__info__item js-navInfo-item">
                                                <h5 class="text-sm tracking-none fw-500">
                                                    Redes Sociais
                                                </h5>

                                                <div class="nav__info__content text-lg text-white mt-16">
                                                    <a href="https://br.linkedin.com/company/benepopfranquia?trk=public_profile_topcard-current-company">Linkedin</a>
                                                    <a href="https://www.instagram.com/benepop_franquias/">Instagram</a>
                                                    <a href="https://www.facebook.com/benepopfranquias/">Facebook</a>
                                                </div>
                                            </div>

                                            <div class="nav__info__item js-navInfo-item">
                                                <h5 class="text-sm tracking-none fw-500">
                                                    Fale Conosco
                                                </h5>

                                                <div class="nav__info__content text-lg text-white mt-16">
                                                    <a href="mailto:contato@benepop.com.br">contato@benepop.com.br</a>
                                                    <a href="phone:08000030313">0800 0030 313</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <!-- nav end -->
                </header>
                <!-- header end -->

                <?php echo $body; ?>

                <!-- footer start -->
                <footer class="footer -type-1 bg-dark-1">
                    <!-- container start -->
                    <div class="container">

                        <div class="footer__top">
                            <!-- row start -->
                            <div class="row y-gap-48 justify-content-between">
                                <div class="col-lg-auto col-sm-12">
                                    <a href="/" class="footer__logo text-white">
                                        <img src="/img/BENEPOP_LOGO_3D.png" alt="Benepop">
                                    </a>
                                </div>

                                <div class="col-lg-3 col-sm-6">
                                    <h4 class="text-xl fw-500 text-white">
                                        Clínica
                                    </h4>

                                    
                                      <div class="footer__content text-base text-light mt-16 sm:mt-12">
                                       <div><a data-barba href="<?php echo base_url('lgpd'); ?>" class="button -underline mt-4">Encontre unidade mais próxima</a></div>
                                        <p class="mt-8">contato@benepop.com.br</p>
                                        <p class="mt-12">0800 0030 313</p>
                                    </div> 
                                </div>

                                <div class="col-lg-auto col-sm-4">
                                    <h4 class="text-xl fw-500 text-white">
                                        Links
                                    </h4>

                                    <div class="footer__content text-base text-light mt-16 sm:mt-12">
                                        <div><a data-barba href="#" class="button -underline mt-4">Fale com Presidente</a></div>
                                      
                                        
                                        <div><a data-barba href="<?php echo base_url('lgpd'); ?>" class="button -underline mt-4">Política de Privacidade</a></div>
                                    </div>
                                </div>

                                <div class="col-lg-auto col-auto">
                                    <h4 class="text-xl fw-500 text-white">
                                        Redes Sociais
                                    </h4>

                                    <div class="social -bordered mt-16 sm:mt-12">
                                        <a class="social__item text-white border-light" href="https://facebook.com/benepopimplantes">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a class="social__item text-white border-light" href="https://facebook.com/benepopimplantes">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                        <a class="social__item text-white border-light" href="https://facebook.com/benepopimplantes">
                                            <i class="fa fa-youtube-play"></i>
                                        </a>
                                        <a class="social__item text-white border-light" href="https://facebook.com/benepopimplantes">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- row end -->
                        </div>


                        <div class="footer__bottom -light">
                            <!-- row start -->
                            <div class="row">
                                <div class="col">
                                    <div class="footer__copyright">
                                        <p class="text-light">
                                            @ 2022, BenePop Franquias. feito por <a href="https://siqueirajr.com" target="_blank"> Siqueira Jr</a>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- row end -->
                        </div>

                    </div>
                    <!-- container end -->
                </footer>
                <!-- footer end -->
               <!-- <a href="https://api.whatsapp.com/send?phone=5541984985910=Olá,%20tudo%20bem?" class="whatsappfloat" target="_blank">
                    <i class="whatsapp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
                        </svg>
                    </i>
                    <span>
                        <small>Fale Conosco</small>
                        <br>
                        <strong> Whatsapp</strong>
                    </span>
                </a> -->


            </main>
            <?php if (isset($unidades)): ?>
                <script>
                    $(document).ready(function () {
                        const carouselClinicas = $('.clinicas .owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
                            responsive: {
                                0: {
                                    items: 1
                                }
                            },
                            navText: [
                                '<img src="/assets/img/tratamentos/seta-dir.png" class="prev">',
                                '<img src="/assets/img/tratamentos/seta-dir.png" class="next">'
                            ]
                        });
                        startInteractiveMap(carouselClinicas);
                    });
                </script>
            <?php endif; ?>
        </div>
        <!-- barba container end -->


        <!-- JavaScript -->
        <script src="/js/vendors.js"></script>
        <script src="/js/main.js"></script>

        <script src="/vendor/owlcarousel-2.3.4/owl.carousel.min.js"></script>
        <script src="/js/imageMapResizer.min.js"></script>

        <script src="/js/mascaras.js"></script>
        <script src="/js/application.js"></script>
        <script src="/js/custom.js"></script>

        <script src="/js/parallax.js"></script>
        <script>
                $(document).ready(function () {
                    $(".parallaxEffect").parallax();
                });
        </script>
        <?php if ($mensagem): ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function(){
                setTimeout(function(){
                    Swal.fire({
                        icon: 'success',
                        title: '<?php echo $mensagem; ?>',
                        timer: 4000
                    })
                },1000);
            })
        </script>
        <?php endif; ?>
    </body>

</html>

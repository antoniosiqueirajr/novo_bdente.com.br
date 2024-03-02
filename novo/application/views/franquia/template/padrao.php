<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="/css/fontawesome.css" rel="stylesheet">


        <!-- Stylesheets -->
        <link rel="stylesheet" href="/css/vendors.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/custom_franquia.css?v=2.8">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

        <title>BenePop Franquias - Realizando Sonhos Implantando Sorrisos  2022</title>
    </head>

    <body class="preloader-visible" data-barba="wrapper">


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


            <main class="<?php echo $main_class ?? ''; ?>">


                <!-- header start -->
                <header class="header logo-300 <?php echo $header_class ?? '-light -sticky-light js-header headroom is-top is-not-bottom'; ?>">
                    <!-- header__bar start -->
                    <div class="header__bar">
                        <div class="header__logo js-header-logo">
                            <a data-barba href="/franquia">
                                <img class="header__logo__light js-lazy" data-srcset="/img/logo-benepop_franquias.png 1x" data-src="/img/logo-benepop_franquias.png" alt="Logo">
                            </a>
                            <a data-barba href="/franquia">
                                <img class="header__logo__dark js-lazy" data-srcset="/img/logo-benepop_franquias.png 1x" data-src="/img/logo-benepop_franquias.png" alt="Logo">
                            </a>
                        </div>

                        <div class="header__menu js-header-menu">
                            <a class="btn-menu-scroll" data-destiny="quem-somos">Quem Somos</a>
                            <a class="btn-menu-scroll" data-destiny="porque-investir">Porque Investir</a>
                            <button type="button" class="nav-button-open js-nav-open">
                                <i class="icon" data-feather="menu"></i>
                            </button>
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
                                                    <a data-barba href="/franquia">
                                                        Home
                                                    </a>
                                                </li>
<!--                                                <li>
                                                    <a data-barba href="/franquia/quem_somos">
                                                        Quem somos?
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/franquia/porque_investir">
                                                        Porque Investir?
                                                    </a>
                                                </li>-->
                                                <!-- <li>
                                                  <a data-barba href="/franquia/clinica_do_futuro">
                                                    Clínica do Futuro
                                                  </a>
                                                </li>
                                                <li>
                                                  <a data-barba href="/franquia/empreendedor_de_sucesso">
                                                    Empreendedor de sucesso
                                                  </a>
                                                </li> -->
                                                <li>
                                                    <a data-barba href="/franquia/blog">
                                                        Noticías
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-barba href="/franquia/fale_conosco">
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
                                                        R. Comendador Macedo, 62  <br>Centro, Curitiba - PR
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
                                                    <a href="#">expansao@benepop.com.br</a>
                                                    <a href="#">41 3045 1633</a>
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

                <div class="border-top-light">
                    <!-- footer start -->
                    <footer class="footer -type-1 bg-dark-1">
                        <!-- container start -->
                        <div class="container">

                            <div class="footer__top">
                                <!-- row start -->
                                <div class="row y-gap-48 justify-content-between">
                                    <div class="col-lg-auto col-sm-12">
                                        <a href="/" class="footer__logo text-white">
                                            <img width="330px" src="/img/logo-benepop.png" alt="BenePop Franquias">
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <h4 class="text-xl fw-500 text-white">
                                            Franquia
                                        </h4>

                                        <div class="footer__content text-base text-light mt-16 sm:mt-12">
                                            <p>R. Comendador Macedo, 62, Centro</p>
                                            <p class="mt-8">expansao@benepop.com.br</p>
                                            <p class="mt-8">41 3045 1633</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-auto col-sm-4">
                                        <h4 class="text-xl fw-500 text-white">
                                            Links
                                        </h4>

                                        <div class="footer__content text-base text-light mt-16 sm:mt-12">
                                            <div><a data-barba onclick="exibirModalFaleComDiretor()" target="_blank" class="button -underline">Fale com Presidente</a></div>
        
                                            <div><a data-barba href="#" target="_blank" class="button -underline mt-4">Fale Conosco</a></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-auto col-auto">
                                        <h4 class="text-xl fw-500 text-white">
                                            Redes Sociais
                                        </h4>

                                        <div class="social -bordered mt-16 sm:mt-12">
                                            <a class="social__item text-white border-light" href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            <a class="social__item text-white border-light" href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                            <a class="social__item text-white border-light" href="#">
                                                <i class="fa fa-youtube-play"></i>
                                            </a>
                                            <a class="social__item text-white border-light" href="#">
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
                                                @ 2020, BenePop Franquias feito por  <a href="https://siqueirajr.com"> Siqueira JR</a>.
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

                </div>
                <a href="https://api.whatsapp.com/send?phone=5541984985910=Olá,%20tudo%20bem?" class="whatsappfloat" target="_blank">
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
                </a>
                <a class="whatsappfloat franquiasFloat" target="_blank" onclick="exibirModalFranquias();">
                    <i class="whatsapp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 26 26">
                        <path d="M2.492 9.074c.332.235 1.32.922 2.973 2.067 1.652 1.148 2.922 2.027 3.8 2.648.094.066.301.215.614.441.316.227.578.41.785.551.207.14.457.297.754.473.293.172.57.305.832.39.262.086.504.13.727.13h.027c.223 0 .465-.044.726-.13.262-.085.54-.218.832-.39.297-.176.547-.332.754-.473.211-.14.47-.324.786-.55.312-.227.52-.376.613-.442.89-.621 3.152-2.191 6.785-4.715a6.849 6.849 0 0 0 1.77-1.781c.476-.695.71-1.426.71-2.188 0-.64-.23-1.187-.687-1.64-.461-.453-1.004-.68-1.633-.68H2.32c-.746 0-1.316.25-1.718.754C.199 4.04 0 4.668 0 5.422c0 .61.266 1.27.797 1.98.531.711 1.098 1.27 1.695 1.672zm0 0"></path>
                        <path d="M24.531 10.629c-3.172 2.144-5.578 3.812-7.218 5-.551.406-1 .723-1.344.95-.344.226-.797.46-1.367.694-.57.239-1.102.356-1.598.356h-.027c-.493 0-1.024-.117-1.594-.356a8.184 8.184 0 0 1-1.371-.695c-.344-.226-.79-.543-1.34-.95-1.309-.956-3.707-2.624-7.207-5A7.745 7.745 0 0 1 0 9.369v11.51c0 .638.227 1.184.68 1.638a2.252 2.252 0 0 0 1.64.683h21.34c.64 0 1.184-.23 1.64-.683.454-.453.68-1 .68-1.637V9.367c-.414.461-.898.883-1.449 1.262zm0 0"></path>
                        </svg>
                    </i>
                    <span>
                        <small>Seja um</small>
                        <br>
                        <strong>Franqueado</strong>
                    </span>
                </a>
                <div id="modal-franquias" class="modal-franquias">
                    <div class="modal-container">
                        <a class="modal-fechar" onclick="fecharModalFranquias();">X</a>
                        <div class="modal-body">
                            <div class="modal-header">
                                <div class="modal-logo">
                                    <img src="/img/BENEPOP_LOGO_3D.png" alt="Benepop">
                                </div>
                                <p>Dê o 1° passo para o seu sucesso!<br>Preencha os dados abaixo e receba o nosso e-book</p>
                            </div>
                            <?php echo form_open('formulario_franquia'); ?>
                            <div class="modal-form">
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>Nome*</label>
                                        <input name="nome" required>
                                    </div>
                                    <div class="modal-field">
                                        <label>E-mail*</label>
                                        <input name="email" required>
                                    </div>
                                </div>
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>Sobrenome*</label>
                                        <input name="sobrenome" required>
                                    </div>
                                    <div class="modal-field">
                                        <label>Telefone*</label>
                                        <input name="telefone" placeholder="41 91234-5678" required type="tel" class="mascara-telefone" >
                                    </div>
                                </div>
                            </div>
                            <p>Região de Interesse</p>
                            <div class="modal-form">
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>Estado</label>
                                        <select name="uf">
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapa</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceara</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espirito Santo</option>
                                            <option value="GO">Goias</option>
                                            <option value="MA">Maranhao</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piaui</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondonia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>Cidade</label>
                                        <input name="cidade">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="ENVIAR">
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div id="modal-diretor" class="modal-franquias">
                    <div class="modal-container">
                        <a class="modal-fechar" onclick="fecharModalFaleComDiretor();">X</a>
                        <div class="modal-body">
                            <div class="modal-header">
                                <div class="modal-logo">
                                    <img src="/img/BENEPOP_LOGO_3D.png" alt="Benepop">
                                </div>
                                <p>Dê o 1° passo para o seu sucesso!<br>Preencha os dados abaixo e receba o nosso e-book</p>
                            </div>
                            <?php echo form_open('formulario_diretor'); ?>
                            <div class="modal-form">
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>Nome*</label>
                                        <input name="nome" required>
                                    </div>
                                </div>
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>Telefone*</label>
                                        <input name="telefone" placeholder="41 91234-5678" required type="tel" class="mascara-telefone" >
                                    </div>
                                </div>
                                <div class="modal-col">
                                    <div class="modal-field">
                                        <label>E-mail*</label>
                                        <input name="email" required type="email">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-form">
                                <div class="modal-col" style="width: 100%;flex: 1;">
                                    <div class="modal-field">
                                        <label>Mensagem*</label>
                                        <textarea name="mensagem" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="ENVIAR">
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </main>

        </div>
        <!-- barba container end -->


        <!-- JavaScript -->
        <script src="/js/vendors.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/countTo.js"></script>
        <script type="text/javascript">
            var modalCount = 0;
            function exibirModalFranquias() {
                $('#modal-franquias').addClass('modal-aberto');
                if (modalCount === 0) {
                    modalCount = 1;
                    mascaras('#modal-franquias');
                }
            }
            function fecharModalFranquias() {
                $('#modal-franquias').removeClass('modal-aberto');
            }
            function exibirModalFaleComDiretor() {
                $('#modal-diretor').addClass('modal-aberto');
                if (modalCount === 0) {
                    modalCount = 1;
                    mascaras('#modal-diretor');
                }
            }
            function fecharModalFaleComDiretor() {
                $('#modal-diretor').removeClass('modal-aberto');
            }
            window.moeda = function moeda(num) {
                x = 0;

                if (num < 0) {
                    num = Math.abs(num);
                    x = 1;
                }
                if (isNaN(num))
                    num = "0";
                cents = Math.floor((num * 100 + 0.5) % 100);

                num = Math.floor((num * 100 + 0.5) / 100).toString();

                if (cents < 10)
                    cents = "0" + cents;
                for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                    num = num.substring(0, num.length - (4 * i + 3)) + "."
                            + num.substring(num.length - (4 * i + 3));
                ret = num + "," + cents;
                if (x == 1)
                    ret = " - " + ret;
                return ret;
            };
            $(document).ready(function () {
                setTimeout(function () {
                    $('.timer').countTo({
                        formatter: function (value, options) {
                            return moeda(value);
                        },
                    });
                    $('.counter-item-modern .counter span').countTo();
                }, 2500);
            })
            $('.btn-menu-scroll').on('click',function(){
                var element = document.querySelector('#'+$(this).attr('data-destiny'));
                element.scrollIntoView({ behavior: 'smooth'});
            });
        </script>
        <script src="/js/mascaras.js?v=1.0"></script>
        <script src="/js/application.js"></script>
        <script src="/js/custom.js"></script>
        <?php if(uri_string() == 'franquia'): ?>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
        <script src="/js/jquery.waypoints.js"></script>
        <script src="/js/donut-chart.js"></script>
        <?php endif; ?>
        <?php if ($mensagem): ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function(){
                setTimeout(function(){
                    Swal.fire({
                        icon: 'success',
                        title: '<?php echo $mensagem; ?>',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },1000);
            })
        </script>
        <?php endif; ?>
    </body>

</html>
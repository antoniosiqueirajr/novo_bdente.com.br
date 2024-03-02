<!-- section start -->
<section class="layout-pt-xl layout-pb-xs">
    <!-- container start -->
    <div data-anim-wrap class="container">

        <!-- row start -->
        <div class="row">
            <div class="col-xl-9 offset-xl-1 col-lg-11">
                <div data-anim-child="slide-up delay-1" class="sectionHeading -lg">
                    <p class="sectionHeading__subtitle">
                        Fale Conosco
                    </p>
                    <h1 class="sectionHeading__title leading-sm">
                        Faça seus implantes na BenePop
                    </h1>
                </div>
            </div>
        </div>
        <!-- row end -->

        <!-- row start -->
        <div data-anim-child="slide-up delay-2" class="row justify-content-center layout-pt-md">
            <div class="col-xl-10">
                <div class="row x-gap-48 y-gap-48">
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <h4 class="text-xl fw-600">
                            Endereço
                        </h4>
                        <div class="text-dark mt-12">
                            <p>R. Comendador Macedo, 62 <br>Centro, Curitiba - PR, 80060-030</p>
                        </div>
                    </div>

                    <div class="col-lg-auto offset-lg-1 col-md-6">
                        <h4 class="text-xl fw-600">
                           Contato
                        </h4>
                        <div class="text-dark mt-12">
                            <div>
                                <a class="button -underline" href="#">contato@benepop.com.br</a>
                            </div>
                            <div class="mt-4">
                                <a class="button -underline" href="#">0800 0030 313</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-auto offset-lg-1">
                        <h4 class="text-xl fw-600">
                           Rede Sociais
                        </h4>
                        <div class="social -bordered mt-16 md:mt-12">

                            <a class="social__item text-black border-dark" href="#">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a class="social__item text-black border-dark" href="#">
                                <i class="fa fa-instagram"></i>
                            </a>

                            <a class="social__item text-black border-dark" href="#">
                                <i class="fa fa-youtube-play"></i>
                            </a>

                            <a class="social__item text-black border-dark" href="#">
                                <i class="fa fa-linkedin"></i>
                            </a>

                        </div>
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
        <div data-anim="slide-up delay-3" class="row justify-content-center is-in-view">
            <div class="col-xl-10">
                <div class="sectionHeading -sm">
                    <h2 class="sectionHeading__title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Deixe-nos uma mensagem
                    </font></font></h2>
                    <p class="text-black leading-md mt-12"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Use o formulário abaixo ou
                         </font></font><a href="#" class="fw-700"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">envie-nos um e-mail</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> .
                    </font></font></p>
                </div>
            </div>

            <div class="w-1/1"></div>

            <div class="col-xl-10 mt-48 sm:mt-32">
                <div class="contact-form -type-1">
                    <?php echo form_open(uri_string(),'class="row x-gap-40 y-gap-32"'); ?>
                        <div class="col-lg-6">
                            <label class="js-input-group"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Nome
                                </font></font><input type="text" name="nome" data-required="" placeholder="Preencha o seu nome" required>
                                <span class="form__error"></span>
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="js-input-group"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Seu número de telefone (opcional)
                                </font></font><input type="text" name="telefone" placeholder="Número de telefone" class="mascara-telefone" required>
                                <span class="form__error"></span>
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="js-input-group"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                E-mail
                                </font></font><input type="text" name="email" data-required="" placeholder="Preencha seu email" required>
                                <span class="form__error"></span>
                            </label>
                        </div>

                        <div class="col-lg-6">
                            <label class="js-input-group"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Assunto
                                </font></font><input type="text" name="assunto" placeholder="O que você está procurando?" required>
                                <span class="form__error"></span>
                            </label>
                        </div>

                        <div class="col-12">
                            <label class="js-input-group"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Mensagem
                                </font></font><textarea name="mensagem" rows="2" placeholder="Preencha sua mensagem" required></textarea>
                                <span class="form__error"></span>
                            </label>
                        </div>

                        <div class="col-12 ajax-form-alert js-ajax-form-alert">
                            <div class="ajax-form-alert__content">
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="button -md -black text-white"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Enviar mensagem
                            </font></font></button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</section>
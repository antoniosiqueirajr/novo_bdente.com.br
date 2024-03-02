<article id="post-23" class="post-23 page type-page status-publish hentry">
    <div class="entry-content">
        <div data-elementor-type="wp-page" data-elementor-id="23" class="elementor elementor-23" data-elementor-post-type="page">
            <div class="elementor-element elementor-element-7da0865 e-con-full e-flex e-con e-parent" data-id="7da0865" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-88549c1 e-flex e-con-boxed e-con e-child" data-id="88549c1" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-66a2bf2 e-con-full e-flex elementor-invisible e-con e-child" data-id="66a2bf2" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}">
                            <div class="elementor-element elementor-element-3766c3b elementor-widget elementor-widget-pt-heading" data-id="3766c3b" data-element_type="widget" data-widget_type="pt-heading.default">
                                <div class="elementor-widget-container">
                                    <div class="pt-heading text-align-center">
                                        
                                    </div>
                                </div>
                            </div>
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
                                                    <div class="item item-mapa-clinicas" data-estado="<?= strtolower($uf); ?>" data-index-mapa="<?= $x; ?>">
                                                        <span class="titulo">
                                                            <span class="estado"><?php //echo $nome; ?></span>
                                                        </span>
                                                        <ul class="cidades">
                                                            <?php foreach($unidades[$uf] ?? array() as $clinica): ?>
                                                            <li><a href="<?= base_url("/unidades/$clinica->link"); ?>"><?= $clinica->nome; ?></a></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-8 offset-1">
                                            <?= $this->load->view('comum/mapa2'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-bf9475b e-flex e-con-boxed e-con e-parent" data-id="bf9475b" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true" id="container-agendar-consulta">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-2382619 e-con-full e-flex elementor-invisible e-con e-child" data-id="2382619" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                        <div class="elementor-element elementor-element-d5864b9 elementor-widget elementor-widget-pt-heading" data-id="d5864b9" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <p class="pt-heading-subtitle">Pronto para Cuidar do Seu Sorriso?</p>
                                    <h2 class="pt-heading-title h2">
                                        Estamos ansiosos para te atender!
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-a6fe52c elementor-widget elementor-widget-pt-contact-form-7" data-id="a6fe52c" data-element_type="widget" data-widget_type="pt-contact-form-7.default">
                            <div class="elementor-widget-container">
                                <div class="pt-contact-form-7">
                                    <div class="wpcf7 no-js" id="wpcf7-f487-p23-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response">
                                            <p role="status" aria-live="polite" aria-atomic="true"></p>
                                            <ul></ul>
                                        </div>
                                        <form action="#" method="post" class="wpcf7-form init" aria-label="Contact form" novalidate="novalidate" data-status="init" id="formulario-agendar-consulta">
                                            <div class="row">
                                                <div class="col-12 mb-4 has-chevron">
                                                    <p>
                                                        <label>Selecione uma Unidade*</label><br>
                                                        <span class="wpcf7-form-control-wrap" data-name="menu-405">
                                                            <select class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false" name="menu-405">
                                                                <option value="1">Curitiba Centro</option>
                                                                <option value="2">Curitiba Boqueirão</option>
                                                                <option value="3">São José dos Pinhais</option>
                                                                <option value="4">Fazenda Rio Grande</option>
                                                            </select>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <p><label>Seu Nome*</label><br>
                                                        <span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" autocomplete="name" aria-required="true" aria-invalid="false" value="" type="text" name="nome"></span>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6 mb-4">
                                                    <p><label>Seu Telefone</label><br>
                                                        <span class="wpcf7-form-control-wrap" data-name="your-phone"><input size="40" class="wpcf7-form-control wpcf7-tel wpcf7-text wpcf7-validates-as-tel" aria-invalid="false" value="" type="tel" name="telefone"></span>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6 mb-4 has-chevron">
                                                    <p><label>Melhor dia</label><br>
                                                        <span class="wpcf7-form-control-wrap" data-name="date-878"><input size="40" class="wpcf7-form-control wpcf7-text walcf7-datepicker" aria-invalid="false" value="" type="text" name="date-878"></span>
                                                    </p>
                                                </div>
                                                <div class="col-12 col-md-6 mb-4 has-chevron">
                                                    <p><label>Melhor Horário</label><br>
                                                        <span class="wpcf7-form-control-wrap" data-name="date-879"><input size="40" class="wpcf7-form-control wpcf7-text walcf7-timepicker" aria-invalid="false" value="" type="text" name="date-879"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div style="margin-top: 8px;">
                                                <p><input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Solicitar Agendamento">
                                                </p>
                                            </div>
                                            <div class="wpcf7-response-echo" aria-hidden="true"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-e04e133 elementor-widget elementor-widget-text-editor" data-id="e04e133" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <p>*Entraremos em contato em até 15 minutos</p>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-99ff100 e-con-full e-flex elementor-invisible e-con e-child" data-id="99ff100" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_delay&quot;:300}">
                        <div class="elementor-element elementor-element-a60ed24 elementor-widget elementor-widget-image" data-id="a60ed24" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <img loading="lazy" decoding="async" width="996" height="1094" src="<?= base_url(); ?>custom/img/julio5.png" class="attachment-full size-full wp-image-372" alt="" sizes="(max-width: 996px) 100vw, 996px">															
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-70656cf e-con-full e-flex e-con e-child" data-id="70656cf" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;position&quot;:&quot;absolute&quot;}">
                            <div class="elementor-element elementor-element-8c3adc5 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="8c3adc5" data-element_type="widget" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-box-wrapper">
                                        <div class="elementor-icon-box-content">
                                            <div class="elementor-icon-box-title">
                                                <a href="#">
                                                    Dr. Julio<br>Diretor Bdente Implantes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
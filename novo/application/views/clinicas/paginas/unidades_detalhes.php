<article id="post-874" class="post-874 page type-page status-publish hentry">
    <div class="entry-content">
        <div data-elementor-type="wp-page" data-elementor-id="874" class="elementor elementor-874" data-elementor-post-type="page">
            <div class="elementor-element elementor-element-e13a6cf e-con-full e-flex elementor-invisible e-con e-parent" data-id="e13a6cf" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-54210b2 e-flex e-con-boxed e-con e-child" data-id="54210b2" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-f467508 elementor-widget__width-initial elementor-widget elementor-widget-pt-heading" data-id="f467508" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-center">
                                    <p class="pt-heading-subtitle">UNIDADE</p>
                                    <h1 class="pt-heading-title h1">
                                        <?= $unidade->nome; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-1a55e13 e-flex e-con-boxed e-con e-parent" data-id="1a55e13" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-87a267d e-con-full e-flex elementor-invisible e-con e-child" data-id="87a267d" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                        <div class="elementor-element elementor-element-65c84bf elementor-widget elementor-widget-pt-heading" data-id="65c84bf" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <h6 class="pt-heading-title h6">
                                        Informações da Unidade
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-f455602 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="f455602" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-31c6741 elementor-widget elementor-widget-text-editor" data-id="31c6741" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.3em;">Responsável</div>
                                <p><?= $unidade->responsavel; ?></p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-6b9840a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="6b9840a" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-d523c4b elementor-widget elementor-widget-text-editor" data-id="d523c4b" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.3em;">CRO</div>
                                <p><?= $unidade->cro; ?></p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-2763b5d elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="2763b5d" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php if($unidade->clm): ?>
                        <div class="elementor-element elementor-element-36c9e1c elementor-widget elementor-widget-text-editor" data-id="36c9e1c" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.3em;">clm</div>
                                <p><?= $unidade->clm; ?></p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-9bb473b elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="9bb473b" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="elementor-element elementor-element-d5c9c50 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="d5c9c50" data-element_type="widget" data-widget_type="icon-box.default">
                            <div class="elementor-widget-container">
                                <link rel="stylesheet" href="<?= base_url(); ?>wp-content/plugins/elementor/assets/css/widget-icon-box.min.css">
                                <div class="elementor-icon-box-wrapper">
                                    <div class="elementor-icon-box-icon">
                                        <a href="#" class="elementor-icon elementor-animation-" tabindex="-1">
                                            <i aria-hidden="true" class="pticon pticon-location"></i>				</a>
                                    </div>
                                    <div class="elementor-icon-box-content">
                                        <div class="elementor-icon-box-title">
                                            <a href="#">
                                                Endereço
                                            </a>
                                        </div>
                                        <p class="elementor-icon-box-description">
                                            <?= $unidade->endereco; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-b4a0b3b elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="b4a0b3b" data-element_type="widget" data-widget_type="icon-box.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-icon-box-wrapper">
                                    <div class="elementor-icon-box-icon">
                                        <a href="#" class="elementor-icon elementor-animation-" tabindex="-1">
                                            <i aria-hidden="true" class="pticon pticon-phone"></i>				</a>
                                    </div>
                                    <div class="elementor-icon-box-content">
                                        <div class="elementor-icon-box-title">
                                            <a href="#">
                                                Telefone
                                            </a>
                                        </div>
                                        <p class="elementor-icon-box-description">
                                            <?= $unidade->telefone; ?>					
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-ba75f41 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="ba75f41" data-element_type="widget" data-widget_type="icon-box.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-icon-box-wrapper">
                                    <div class="elementor-icon-box-icon">
                                        <a href="#" class="elementor-icon elementor-animation-" tabindex="-1">
                                            <i aria-hidden="true" class="pticon pticon-envelope"></i>				</a>
                                    </div>
                                    <div class="elementor-icon-box-content">
                                        <div class="elementor-icon-box-title">
                                            <a href="#">
                                                E-Mail
                                            </a>
                                        </div>
                                        <p class="elementor-icon-box-description">
                                            <?= $unidade->email; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-c549c19 e-con-full e-flex elementor-invisible e-con e-child" data-id="c549c19" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;}">
                        <div class="elementor-element elementor-element-95303fc elementor-widget elementor-widget-image" data-id="95303fc" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <style>/*! elementor - v3.18.0 - 20-12-2023 */
                                    .elementor-widget-image{
                                        text-align:center
                                    }
                                    .elementor-widget-image a{
                                        display:inline-block
                                    }
                                    .elementor-widget-image a img[src$=".svg"]{
                                        width:48px
                                    }
                                    .elementor-widget-image img{
                                        vertical-align:middle;
                                        display:inline-block
                                    }
                                </style>
                                <img loading="lazy" decoding="async" width="1632" height="960" src="<?= base_url($unidade->imagem); ?>" class="attachment-full size-full wp-image-854" alt="" sizes="(max-width: 1632px) 100vw, 1632px">
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-4592b42 elementor-widget elementor-widget-pt-heading" data-id="4592b42" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <h3 class="pt-heading-title h3">
                                        Sobre a Unidade
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-add28af elementor-widget elementor-widget-text-editor" data-id="add28af" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <?= $unidade->descricao; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
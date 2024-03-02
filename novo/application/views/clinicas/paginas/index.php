<article id="post-23" class="post-23 page type-page status-publish hentry">
    <div class="entry-content">
        <div data-elementor-type="wp-page" data-elementor-id="23" class="elementor elementor-23" data-elementor-post-type="page">
            <div class="banner-principal">
                <div class="owl-carousel owl-theme" id="banner-principal-carossel">
                    <?php foreach($banners as $banner): ?>
                    <div class="item">
                        <img src="<?= base_url($banner->imagem); ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="miniaturas">
                    <?php foreach($banners as $x=>$banner): ?>
                    <a class="miniatura" onclick="$('#banner-principal-carossel').trigger('to.owl.carousel', [<?= $x; ?>,300]);">
                        <div class="imagem" style="background-image: url(<?= base_url($banner->imagem); ?>);">
                        </div>
                        <div class="titulo">
                            <?= $banner->titulo; ?>"
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="elementor-element elementor-element-12cb094 e-con-full e-flex elementor-invisible e-con e-parent" data-id="12cb094" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-e37b61b elementor-widget elementor-widget-pt-text-marquee" data-id="e37b61b" data-element_type="widget" data-widget_type="pt-text-marquee.default">
                    <div class="elementor-widget-container">
                        <div class="pt-text-marquee ">
                            <div class="pt-text-marquee-original">
                                <div class="pt-text-marquee-text elementor-repeater-item-2a923fb">
                                    <i aria-hidden="true" class="pticon pticon-tooth"></i>
                                    Revitalize seu sorriso e aumente sua autoconfiança por meio de nossa odontologia especializada.
                                </div>
                                <div class="pt-text-marquee-text elementor-repeater-item-b3a48e7">
                                    <i aria-hidden="true" class="pticon pticon-tooth"></i>
                                    Transforme seu sorriso e sua confiança com nossos cuidados odontológicos especializados.
                                </div>
                                <div class="pt-text-marquee-text elementor-repeater-item-e8b571d">
                                    <i aria-hidden="true" class="pticon pticon-like"></i>
                                    Experimente uma transformação que vai além de seus dentes, criando uma versão confiante e radiante de você mesmo.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-0462820 e-flex e-con-boxed e-con e-parent" data-id="0462820" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-3dfdbac e-con-full e-flex elementor-invisible e-con e-child" data-id="3dfdbac" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                        <div class="elementor-element elementor-element-9134c1f elementor-widget elementor-widget-image" data-id="9134c1f" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <style>/*! elementor - v3.18.0 - 20-12-2023 */
                                    .elementor-widget-image{text-align:center}.elementor-widget-image a{display:inline-block}.elementor-widget-image a img[src$=".svg"]{width:48px}.elementor-widget-image img{vertical-align:middle;display:inline-block}
                                </style>
                                <img loading="lazy" decoding="async" width="996" height="1080" src="<?= base_url(); ?>public/images/porque_escolher.jpg" class="attachment-full size-full wp-image-351" alt="" sizes="(max-width: 996px) 100vw, 996px">															
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-1a524fc e-con-full e-flex e-con e-child" data-id="1a524fc" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;position&quot;:&quot;absolute&quot;}">
                            <div class="elementor-element elementor-element-cd97b63 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="cd97b63" data-element_type="widget" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-box-wrapper">
                                        <div class="elementor-icon-box-icon">
                                            <a href="#" class="elementor-icon elementor-animation-" tabindex="-1">
                                            <i aria-hidden="true" class="pticon pticon-checkmark"></i>				</a>
                                        </div>
                                        <div class="elementor-icon-box-content">
                                            <div class="elementor-icon-box-title">
                                                <a href="#">
                                                Melhores resultados
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-b922181 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="b922181" data-element_type="widget" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-box-wrapper">
                                        <div class="elementor-icon-box-icon">
                                            <a href="#" class="elementor-icon elementor-animation-" tabindex="-1">
                                            <i aria-hidden="true" class="pticon pticon-checkmark"></i>				</a>
                                        </div>
                                        <div class="elementor-icon-box-content">
                                            <div class="elementor-icon-box-title">
                                                <a href="#">
                                                Maior Conforto e Estética
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-920bbf5 e-con-full e-flex elementor-invisible e-con e-child" data-id="920bbf5" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_delay&quot;:300}">
                        <div class="elementor-element elementor-element-8f738e6 elementor-widget elementor-widget-pt-heading" data-id="8f738e6" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <p class="pt-heading-subtitle">Por que escolher a BDente</p>
                                    <h2 class="pt-heading-title h2">
                                        Compromisso com a saúde e qualidade de vida
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-6ff3df3 elementor-widget elementor-widget-text-editor" data-id="6ff3df3" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <p>“Com uma abordagem humanizada e uma equipe de profissionais altamente capacitados, proporcionamos atendimento de excelência, incorporando tecnologia de última geração para garantir os melhores resultados e o máximo conforto aos nossos pacientes.”</p>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-ef9d141 elementor-widget elementor-widget-pt-simple-links" data-id="ef9d141" data-element_type="widget" data-widget_type="pt-simple-links.default">
                            <div class="elementor-widget-container">
                                <div class="pt-simple-links style-2">
                                    <a onclick="$('#porque_escolher_implantes').slideToggle();">Implantes Dentários</a>
                                    <div id="porque_escolher_implantes">
                                        Os Implantes Dentários são soluções inovadoras para aqueles que perderam um ou mais dentes. Além de restaurar a função mastigatória, proporcionam uma estética natural. Na Bdente Implantes, oferecemos uma variedade de opções, desde o implante unitário até a prótese protocolo, que devolve todos os dentes de uma arcada de uma só vez.
                                    </div>
                                    <div class="divider"></div>
                                    <a onclick="$('#porque_escolher_estetica').slideToggle();">Estética Dental</a>
                                    <div style="display: none" id="porque_escolher_estetica">
                                        A estética dental abrange procedimentos como clareamento dental, limpeza profissional, facetas e lentes de contato dental para aprimorar a estética do sorriso. Nossa abordagem personalizada entrega resultados excepcionais. 
                                    </div>
                                    <div class="divider"></div>
                                    <a onclick="$('#porque_escolher_harmonizacao').slideToggle();">Harmonização Facial</a>
                                    <div style="display: none" id="porque_escolher_harmonizacao">
                                        A Harmonização Facial é um conjunto de procedimentos que visa realçar a beleza do rosto. Algumas correções podem ser realizadas por meio de técnicas como preenchimento labial, botox e outros tratamentos personalizados. Nossa equipe especializada trabalha para equilibrar e aprimorar a harmonia facial de cada paciente.
                                    </div>
                                    <div class="divider"></div>
                                    <a onclick="$('#porque_escolher_restauracao').slideToggle();">Odontologia Restauradora</a>
                                    <div style="display: none" id="porque_escolher_restauracao">
                                        A Odontologia Restauradora foca na preservação e recuperação da saúde bucal. Engloba tratamentos como restaurações, obturações e procedimentos para corrigir danos causados por cáries ou desgastes. 
                                    </div>
                                    <div class="divider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-7093c9b e-flex e-con-boxed e-con e-parent" data-id="7093c9b" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;shape_divider_top&quot;:&quot;curve&quot;,&quot;content_width&quot;:&quot;boxed&quot;}" data-core-v316-plus="true">
                <div class="e-con-inner">
                    <div class="elementor-shape elementor-shape-top" data-negative="false">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1000 100" preserveaspectratio="none">
                            <path class="elementor-shape-fill" d="M1000,4.3V0H0v4.3C0.9,23.1,126.7,99.2,500,100S1000,22.7,1000,4.3z"></path>
                        </svg>
                    </div>
                    <div class="elementor-element elementor-element-8a091b2 e-flex e-con-boxed e-con e-child" data-id="8a091b2" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                        <div class="e-con-inner">
                            <div class="elementor-element elementor-element-34ef5ba e-con-full e-flex e-con e-child" data-id="34ef5ba" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-922ce65 elementor-widget elementor-widget-pt-heading" data-id="922ce65" data-element_type="widget" data-widget_type="pt-heading.default">
                                    <div class="elementor-widget-container">
                                        <div class="pt-heading text-align-">
                                            <p class="pt-heading-subtitle">Nossos Serviços</p>
                                            <h2 class="pt-heading-title h2">
                                                Serviços odontológicos sem mistério<br>
                                                Atendimento para toda a família!
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-9f01767 elementor-invisible elementor-widget elementor-widget-text-editor" data-id="9f01767" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <p>Da prevensão ao implante, nosso time está comprometido há lhe oferecer o tratamento correto para o seu caso.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-f5053ff e-con-full e-flex e-con e-child" data-id="f5053ff" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-8dd485c elementor-invisible elementor-widget elementor-widget-pt-button" data-id="8dd485c" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInRight&quot;}" data-widget_type="pt-button.default">
                                    <div class="elementor-widget-container">
                                        <a class="pt-button filled " href="<?= base_url(); ?>tratamentos">
                                        <span>Veja todos os nossos serviços</span>
                                        <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-869589f e-con-full e-flex elementor-invisible e-con e-child" data-id="869589f" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}">
                        <div class="elementor-element elementor-element-ac79d68 elementor-widget elementor-widget-pt-heading" data-id="ac79d68" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <h6 class="pt-heading-title h6">
                                        Veja nossos tratamentos
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-7c65cf3 e-con-full e-flex e-con e-child" data-id="7c65cf3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                            <?php foreach($tratamentos as $x=>$tratamento): ?>
                            <?php if($x <=1): ?>
                            <div class="elementor-element elementor-element-3c6de8b e-con-full light-text-on-hover e-flex e-con e-child" data-id="3c6de8b" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-element elementor-element-edbeefe elementor-widget elementor-widget-pt-heading" data-id="edbeefe" data-element_type="widget" data-widget_type="pt-heading.default">
                                    <div class="elementor-widget-container">
                                        <div class="pt-heading text-align-">
                                            <h4 class="pt-heading-title h4">
                                                <?= $tratamento->nome; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-3923283 elementor-widget elementor-widget-pt-button" data-id="3923283" data-element_type="widget" data-widget_type="pt-button.default">
                                    <div class="elementor-widget-container">
                                        <a class="pt-button textual " href="<?= base_url() ?>/tratamentos#<?= make_link($tratamento->nome); ?>">
                                        <span>Saiba Mais</span>
                                        <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-0caf4a1 elementor-absolute elementor-widget elementor-widget-image" data-id="0caf4a1" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img loading="lazy" decoding="async" width="564" height="554" src="<?= base_url($tratamento->imagem_over); ?>" class="attachment-full size-full wp-image-1153" alt="" sizes="(max-width: 564px) 100vw, 564px">
                                    </div>
                                </div>
                            </div>
                            <?php elseif($x == 2): ?>
                        </div>
                        <div class="elementor-element elementor-element-281aaef e-con-full e-flex e-con e-child" data-id="281aaef" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                            <div class="elementor-element elementor-element-3e0fcf3 e-con-full light-text-on-hover e-flex e-con e-child" data-id="3e0fcf3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-element elementor-element-7108ccc elementor-widget elementor-widget-pt-heading" data-id="7108ccc" data-element_type="widget" data-widget_type="pt-heading.default">
                                    <div class="elementor-widget-container">
                                        <div class="pt-heading text-align-">
                                            <h4 class="pt-heading-title h4">
                                                <?= $tratamento->nome; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-f280797 elementor-widget elementor-widget-pt-button" data-id="f280797" data-element_type="widget" data-widget_type="pt-button.default">
                                    <div class="elementor-widget-container">
                                        <a class="pt-button textual " href="<?= base_url() ?>/tratamentos#<?= make_link($tratamento->nome); ?>">
                                        <span>Saiba Mais</span>
                                        <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-06f5130 elementor-absolute elementor-widget elementor-widget-image" data-id="06f5130" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img loading="lazy" decoding="async" width="286" height="566" src="<?= base_url($tratamento->imagem_over); ?>" class="attachment-full size-full wp-image-1164" alt="" sizes="(max-width: 286px) 100vw, 286px">															
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="elementor-element elementor-element-3e0fcf3 e-con-full light-text-on-hover e-flex e-con e-child" data-id="3e0fcf3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-element elementor-element-7108ccc elementor-widget elementor-widget-pt-heading" data-id="7108ccc" data-element_type="widget" data-widget_type="pt-heading.default">
                                    <div class="elementor-widget-container">
                                        <div class="pt-heading text-align-">
                                            <h4 class="pt-heading-title h4">
                                                <?= $tratamento->nome; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-f280797 elementor-widget elementor-widget-pt-button" data-id="f280797" data-element_type="widget" data-widget_type="pt-button.default">
                                    <div class="elementor-widget-container">
                                        <a class="pt-button textual " href="<?= base_url() ?>/tratamentos#<?= make_link($tratamento->nome); ?>">
                                        <span>Saiba Mais</span>
                                        <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-06f5130 elementor-absolute elementor-widget elementor-widget-image" data-id="06f5130" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img loading="lazy" decoding="async" width="286" height="566" src="<?= base_url($tratamento->imagem_over); ?>" class="attachment-full size-full wp-image-1164" alt="" sizes="(max-width: 286px) 100vw, 286px">															
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
<!--                                    <div class="elementor-element elementor-element-58b5e12 elementor-widget elementor-widget-pt-heading" data-id="58b5e12" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-center">
                                    <h5 class="pt-heading-title h5">
                                        Marcas e Empresas Parceiras
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-9afe5b5 elementor-widget elementor-widget-pt-brands" data-id="9afe5b5" data-element_type="widget" data-settings="{&quot;carousel&quot;:&quot;yes&quot;,&quot;cols&quot;:&quot;5&quot;,&quot;cols_tablet&quot;:&quot;4&quot;,&quot;loop&quot;:&quot;yes&quot;,&quot;arrows&quot;:&quot;yes&quot;,&quot;cols_mobile&quot;:2}" data-widget_type="pt-brands.default">
                            <div class="elementor-widget-container">
                                <div class="pt-brands ">
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="pt-brand">
                                                    <div class="pt-brand-inner">
                                                        <a href="portfolio/index.htm">
                                                        <img loading="lazy" decoding="async" width="212" height="268" src="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-03.webp" class="attachment-full size-full" alt="">						
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="pt-brand">
                                                    <div class="pt-brand-inner">
                                                        <a href="portfolio/index.htm">
                                                        <img loading="lazy" decoding="async" width="212" height="268" src="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-04.webp" class="attachment-full size-full" alt="">						
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="pt-brand">
                                                    <div class="pt-brand-inner">
                                                        <a href="portfolio/index.htm">
                                                        <img loading="lazy" decoding="async" width="212" height="268" src="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-05.webp" class="attachment-full size-full" alt="">						
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="pt-brand">
                                                    <div class="pt-brand-inner">
                                                        <a href="portfolio/index.htm">
                                                        <img loading="lazy" decoding="async" width="212" height="268" src="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-06.webp" class="attachment-full size-full" alt="">						
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="pt-brand">
                                                    <div class="pt-brand-inner">
                                                        <a href="portfolio/index.htm">
                                                        <img loading="lazy" decoding="async" width="212" height="268" src="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-07.webp" class="attachment-full size-full" alt="">						
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-swiper-arrows">
                                        <div class="pt-swiper-button-prev"></div>
                                        <div class="pt-swiper-button-next"></div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-ca8b4f8 e-con-full e-flex e-con e-parent" data-id="ca8b4f8" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-bc0cc33 e-flex e-con-boxed e-con e-child" data-id="bc0cc33" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-9d75a6d e-flex e-con-boxed e-con e-child" data-id="9d75a6d" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-29a8623 e-con-full e-flex elementor-invisible e-con e-child" data-id="29a8623" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;}">
                                    <div class="elementor-element elementor-element-8abc5be elementor-widget elementor-widget-pt-heading" data-id="8abc5be" data-element_type="widget" data-widget_type="pt-heading.default">
                                        <div class="elementor-widget-container">
                                            <div class="pt-heading text-align-">
                                                <p class="pt-heading-subtitle">Passo a passo</p>
                                                <h2 class="pt-heading-title h2">
                                                    A sua jornada começa aqui
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-e41c5e3 elementor-widget elementor-widget-text-editor" data-id="e41c5e3" data-element_type="widget" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>Uma equipe entusiasmada aguarda para te guiar rumo ao seu novo sorriso. Com dedicação e qualidade excepcionais, nossos profissionais qualificados estão prontos para tornar sua experiência odontológica única e satisfatória.</p>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-2a89322 elementor-widget elementor-widget-pt-button" data-id="2a89322" data-element_type="widget" data-widget_type="pt-button.default">
                                        <div class="elementor-widget-container">
                                            <a class="pt-button filled " href="#container-agendar-consulta">
                                            <span>Agende uma avaliação</span>
                                            <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-f92e153 e-con-full e-flex elementor-invisible e-con e-child" data-id="f92e153" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_delay&quot;:300}">
                                    <div class="elementor-element elementor-element-a26c836 accordion-style-numbered elementor-widget elementor-widget-pt-accordion" data-id="a26c836" data-element_type="widget" data-settings="{&quot;style&quot;:&quot;style-2&quot;}" data-widget_type="pt-accordion.default">
                                        <div class="elementor-widget-container">
                                            <div class="pt-accordion style-2">
                                                <div class="pt-accordion-title">
                                                    <span>Agende Sua Avaliação</span>
                                                </div>
                                                <div class="pt-accordion-content">
                                                    Agendar sua avaliação é o primeiro passo. Nossa equipe na central de agendamentos está pronta para receber seu contato, garantindo uma consulta no melhor dia, horário e na unidade mais conveniente para você.
                                                </div>
                                                <div class="pt-accordion-title">
                                                    <span>Exame Clínico</span>
                                                </div>
                                                <div class="pt-accordion-content">
                                                    Chegou o dia da sua avaliação. Nossos profissionais realizarão uma análise detalhada, oferecendo o melhor plano de tratamento. Todas as suas dúvidas serão esclarecidas, assegurando que você saia da Bdente com a certeza de que realizará o seu sonho.
                                                </div>
                                                <div class="pt-accordion-title">
                                                    <span>Plano de Tratamento</span>
                                                </div>
                                                <div class="pt-accordion-content">
                                                    Após a avaliação, detalharemos cada passo do seu tratamento, desde o primeiro exame até o procedimento final. Tudo adaptado à sua realidade. Nossa equipe está comprometida em atender suas necessidades de forma personalizada.
                                                </div>
                                                <div class="pt-accordion-title">
                                                    <span>O Dia da Transformação</span>
                                                </div>
                                                <div class="pt-accordion-content">
                                                    Chegou o dia do seu tratamento, e toda a equipe está mobilizada para tornar sua experiência tranquila e agradável. Utilizamos as melhores tecnologias para garantir que você tenha um tratamento confortável e livre de estresse.
                                                </div>
                                                <div class="pt-accordion-title">
                                                    <span>Cuidado Contínuo</span>
                                                </div>
                                                <div class="pt-accordion-content">
                                                    Oferecemos todo o suporte necessário após o seu tratamento, garantindo que sua jornada para um novo sorriso seja completa e satisfatória.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-1a36323 e-con-full e-flex e-con e-child" data-id="1a36323" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                            <div class="elementor-element elementor-element-f9a2131 elementor-widget elementor-widget-pt-heading" data-id="f9a2131" data-element_type="widget" data-widget_type="pt-heading.default">
                                <div class="elementor-widget-container">
                                    <div class="pt-heading text-align-center">
                                        <p class="pt-heading-subtitle">Portifólio de Sorrisos > Inspire-se</p>
                                        <h2 class="pt-heading-title h2">
                                            Sorrisos que contam histórias
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-08de5f4 e-con-full e-flex e-con e-child" data-id="08de5f4" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                            <div class="elementor-element elementor-element-e3dc670 elementor-invisible elementor-widget elementor-widget-pt-portfolio" data-id="e3dc670" data-element_type="widget" data-settings="{&quot;type&quot;:&quot;justified&quot;,&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;navigation&quot;:&quot;none&quot;}" data-widget_type="pt-portfolio.default">
                                <div class="elementor-widget-container">
                                    <div class="pt-portfolio portfolio-block filter-block portfolio-type-justified  popup-gallery" data-popup-settings="{&quot;popupTitle&quot;:false,&quot;popupDesc&quot;:false}">
                                        <div class="row isotope">
                                            <div class="grid-sizer col-1"></div>
                                            <article data-index="0" class="portfolio-item istp-item category-24 popup-item">
                                                <div class="wrap">
                                                    <div class="entry-thumb portfolio">
                                                        <a href="#" data-popup-json="{&quot;title&quot;:&quot;Smile Transformation: Comprehensive Aesthetic Dentistry&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-58.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:858},&quot;post_id&quot;:220,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/smile-transformation-comprehensive-aesthetic-dentistry\/&quot;}" data-id="0" data-filled-cursor="true">
                                                            <img loading="lazy" decoding="async" width="1024" height="747" src="<?= base_url($cases[0]->imagem); ?>" class="attachment-large size-large" alt="" sizes="(max-width: 1024px) 100vw, 1024px">
                                                        </a>
                                                    </div>
                                                    <div class="entry-caption">
                                                        <div class="entry-date"><?= strftime('%d de %B de %Y',strtotime($cases[0]->data)) ?></div>
                                                        <h6 class="entry-title">
                                                            <a href="#" data-popup-json="{&quot;title&quot;:&quot;Smile Transformation: Comprehensive Aesthetic Dentistry&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-58.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:858},&quot;post_id&quot;:220,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/smile-transformation-comprehensive-aesthetic-dentistry\/&quot;}" data-id="0" data-filled-cursor="true">
                                                            <?= $cases[0]->titulo; ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <article data-index="1" class="portfolio-item istp-item category-22 category-39 category-40 popup-item">
                                                <div class="wrap">
                                                    <div class="entry-thumb portfolio">
                                                        <a href="#" data-popup-json="{&quot;title&quot;:&quot;Overcoming Dental Anxiety: A Gentle Approach to Patient Care&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-61.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:900},&quot;post_id&quot;:219,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/overcoming-dental-anxiety-a-gentle-approach-to-patient-care\/&quot;}" data-id="1" data-filled-cursor="true">
                                                            <img loading="lazy" decoding="async" width="1024" height="784" src="<?= base_url($cases[1]->imagem); ?>" sizes="(max-width: 1024px) 100vw, 1024px">
                                                        </a>
                                                    </div>
                                                    <div class="entry-caption">
                                                        <div class="entry-date"><?= strftime('%d de %B de %Y',strtotime($cases[1]->data)) ?></div>
                                                        <h6 class="entry-title">
                                                            <a href="#" data-popup-json="{&quot;title&quot;:&quot;Overcoming Dental Anxiety: A Gentle Approach to Patient Care&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-61.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:900},&quot;post_id&quot;:219,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/overcoming-dental-anxiety-a-gentle-approach-to-patient-care\/&quot;}" data-id="1" data-filled-cursor="true">
                                                            <?= $cases[1]->titulo; ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <article data-index="2" class="portfolio-item istp-item category-23 popup-item">
                                                <div class="wrap">
                                                    <div class="entry-thumb portfolio">
                                                        <a href="#" data-popup-json="{&quot;title&quot;:&quot;Full Mouth Reconstruction: Restoring Oral Health and Function&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-59.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:900},&quot;post_id&quot;:218,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/full-mouth-reconstruction-restoring-oral-health-and-function\/&quot;}" data-id="2" data-filled-cursor="true">
                                                        <img loading="lazy" decoding="async" width="1024" height="784" src="<?= base_url().$cases[2]->imagem; ?>" sizes="(max-width: 1024px) 100vw, 1024px">					</a>
                                                    </div>
                                                    <div class="entry-caption">
                                                        <div class="entry-date"><?= strftime('%d de %B de %Y',strtotime($cases[2]->data)) ?></div>
                                                        <h6 class="entry-title">
                                                            <a href="#" data-popup-json="{&quot;title&quot;:&quot;Full Mouth Reconstruction: Restoring Oral Health and Function&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-59.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:900},&quot;post_id&quot;:218,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/full-mouth-reconstruction-restoring-oral-health-and-function\/&quot;}" data-id="2" data-filled-cursor="true">
                                                            <?= $cases[2]->titulo; ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <article data-index="3" class="portfolio-item istp-item category-24 category-39 category-40 popup-item">
                                                <div class="wrap">
                                                    <div class="entry-thumb portfolio">
                                                        <a href="#" data-popup-json="{&quot;title&quot;:&quot;Invisible Braces Success Story&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-60.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:900},&quot;post_id&quot;:191,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/invisible-braces-success-story\/&quot;}" data-id="3" data-filled-cursor="true">
                                                        <img loading="lazy" decoding="async" width="1024" height="784" src="<?= base_url().$cases[3]->imagem; ?>" sizes="(max-width: 1024px) 100vw, 1024px">					</a>
                                                    </div>
                                                    <div class="entry-caption">
                                                        <div class="entry-date"><?= strftime('%d de %B de %Y',strtotime($cases[3]->data)) ?></div>
                                                        <h6 class="entry-title">
                                                            <a href="#" data-popup-json="{&quot;title&quot;:&quot;Invisible Braces Success Story&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-60.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:900},&quot;post_id&quot;:191,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/invisible-braces-success-story\/&quot;}" data-id="3" data-filled-cursor="true">
                                                            <?= $cases[3]->titulo; ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <article data-index="4" class="portfolio-item istp-item category-22 popup-item">
                                                <div class="wrap">
                                                    <div class="entry-thumb portfolio">
                                                        <a href="#" data-popup-json="{&quot;title&quot;:&quot;Implant Dentistry Excellence&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-57.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:858},&quot;post_id&quot;:190,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/implant-dentistry-excellence\/&quot;}" data-id="4" data-filled-cursor="true">
                                                        <img loading="lazy" decoding="async" width="1024" height="747" src="<?= base_url().$cases[4]->imagem; ?>" sizes="(max-width: 1024px) 100vw, 1024px">					</a>
                                                    </div>
                                                    <div class="entry-caption">
                                                        <div class="entry-date"><?= strftime('%d de %B de %Y',strtotime($cases[4]->data)) ?></div>
                                                        <h6 class="entry-title">
                                                            <a href="#" data-popup-json="{&quot;title&quot;:&quot;Implant Dentistry Excellence&quot;,&quot;desc&quot;:false,&quot;image&quot;:{&quot;url&quot;:&quot;https:wp-content\/uploads\/2023\/12\/densmi-57.webp&quot;,&quot;w&quot;:1176,&quot;h&quot;:858},&quot;post_id&quot;:190,&quot;likes&quot;:0,&quot;projectLink&quot;:&quot;https:pt-portfolio\/implant-dentistry-excellence\/&quot;}" data-id="4" data-filled-cursor="true">
                                                            <?= $cases[4]->titulo; ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-8dd8fb9 elementor-absolute elementor-invisible elementor-widget elementor-widget-pt-button" data-id="8dd8fb9" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:400}" data-widget_type="pt-button.default">
                                <div class="elementor-widget-container">
                                    <a class="pt-button filled " href="blog">
                                    <span>Ir para o Blog</span>
                                    <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-adc8517 e-con-full e-flex e-con e-parent" data-id="adc8517" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-beeaea5 e-flex e-con-boxed e-con e-child" data-id="beeaea5" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-874b1ee elementor-widget elementor-widget-pt-heading" data-id="874b1ee" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <p class="pt-heading-subtitle">Testemunhos</p>
                                    <h2 class="pt-heading-title h2">
                                        Veja o que nossos clientes falam sobre nós
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-b31998c e-con-full e-flex e-con e-child" data-id="b31998c" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                            <div class="elementor-element elementor-element-736e7f3 e-con-full e-flex e-con e-child" data-id="736e7f3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-be1c591 swiper-left-part-visible testimonials-overflow-hidden-right elementor-invisible elementor-widget elementor-widget-pt-testimonials" data-id="be1c591" data-element_type="widget" data-settings="{&quot;layout&quot;:&quot;carousel&quot;,&quot;cols&quot;:2,&quot;loop&quot;:&quot;yes&quot;,&quot;arrows_position&quot;:&quot;together&quot;,&quot;_animation&quot;:&quot;fadeInLeft&quot;,&quot;cols_tablet&quot;:1,&quot;cols_mobile&quot;:1,&quot;arrows&quot;:&quot;yes&quot;}" data-widget_type="pt-testimonials.default">
                                    <div class="elementor-widget-container">
                                        <div class="pt-testimonials  layout-carousel text-align- arrows-together arrows-align-bottom-left">
                                            <div class="swiper">
                                                <div class="swiper-wrapper">
                                                    <?php foreach($depoimentos as $depoimento): ?>
                                                    <div class="swiper-slide">
                                                        <div class="pt-testimonial elementor-repeater-item-e7788d4">
                                                            <div class="pt-testimonial-content">
                                                                <div class="pt-testimonial-meta">
                                                                    <div class="pt-testimonial-avatar">
                                                                        <img loading="lazy" decoding="async" width="112" height="112" src="<?= base_url($depoimento->imagem); ?>" class="attachment-full size-full" alt="">		
                                                                    </div>
                                                                    <div class="pt-testimonial-author-wrapper">
                                                                        <div class="pt-testimonial-author">
                                                                            <?= $depoimento->nome; ?>
                                                                        </div>
                                                                        <div class="pt-testimonial-occupation">
                                                                            <?= $depoimento->cargo; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-testimonial-text">
                                                                    <?= $depoimento->depoimento; ?>
                                                                </div>
                                                                <div class="pt-testimonial-rating pt-rating">
                                                                    <i class="pt-star-full">&#9733;</i><i class="pt-star-full">&#9733;</i><i class="pt-star-full">&#9733;</i><i class="pt-star-full">&#9733;</i><i class="pt-star-empty">&#9733;</i>		
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="pt-swiper-arrows">
                                                <div class="pt-swiper-button-prev"></div>
                                                <div class="pt-swiper-button-next"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-db328b3 e-con-full e-flex elementor-invisible e-con e-child" data-id="db328b3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeIn&quot;}">
                                <div class="elementor-element elementor-element-cf38c1f e-con-full has-circle-decor e-flex e-con e-child" data-id="cf38c1f" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
                                </div>
                                <div class="elementor-element elementor-element-74559ca elementor-absolute elementor-widget elementor-widget-image" data-id="74559ca" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img loading="lazy" decoding="async" width="650" height="824" src="<?= base_url(); ?>custom/img/julio1.png" class="attachment-full size-full wp-image-1108" alt="" sizes="(max-width: 650px) 100vw, 650px">															
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-38b5c10 elementor-absolute elementor-view-default elementor-widget elementor-widget-icon" data-id="38b5c10" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="icon.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-wrapper">
                                            <div class="elementor-icon">
                                                <i aria-hidden="true" class="pticon pticon-quote"></i>			
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-1f247a3 e-con-full e-flex e-con e-parent" data-id="1f247a3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;gradient&quot;,&quot;shape_divider_bottom&quot;:&quot;curve&quot;}" data-core-v316-plus="true">
                <div class="elementor-shape elementor-shape-top" data-negative="false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 1000 100" preserveaspectratio="none">
                        <path class="elementor-shape-fill" d="M1000,4.3V0H0v4.3C0.9,23.1,126.7,99.2,500,100S1000,22.7,1000,4.3z"></path>
                    </svg>
                </div>
                <div class="elementor-element elementor-element-1a25ff5 e-flex e-con-boxed e-con e-child" data-id="1a25ff5" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner" id="faq">
                        <div class="elementor-element elementor-element-727e068 elementor-widget elementor-widget-pt-heading" data-id="727e068" data-element_type="widget" data-widget_type="pt-heading.default">
                            <div class="elementor-widget-container">
                                <div class="pt-heading text-align-">
                                    <p class="pt-heading-subtitle">FAQ</p>
                                    <h2 class="pt-heading-title h2">
                                        Dúvidas frequentes
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-d70c7c0 e-flex e-con-boxed e-con e-child" data-id="d70c7c0" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-9cd1dd8 elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-invisible elementor-widget elementor-widget-pt-accordion" data-id="9cd1dd8" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}" data-widget_type="pt-accordion.default">
                            <div class="elementor-widget-container">
                                <div class="pt-accordion ">
                                    <div class="pt-accordion-title">
                                        <span>Qual a importância da higiene bucal?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        A higiene bucal é crucial para prevenir cáries, doenças gengivais e outros problemas. Escovação adequada, uso do fio dental e visitas regulares ao dentista são fundamentais.
                                    </div>
                                    <div class="pt-accordion-title">
                                        <span>Com que frequência devo fazer check-ups dentários?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        Recomenda-se visitar o dentista pelo menos duas vezes ao ano para check-ups preventivos e limpezas. No entanto, a frequência pode variar com base nas necessidades individuais.
                                    </div>
                                    <div class="pt-accordion-title">
                                        <span>O que é odontologia preventiva?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        A odontologia preventiva foca na prevenção de problemas bucais antes que ocorram. Inclui check-ups regulares, limpezas, aplicação de selantes e educação sobre higiene oral.
                                    </div>
                                    <div class="pt-accordion-title">
                                        <span>Quais são os benefícios dos tratamentos ortodônticos?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        Os tratamentos ortodônticos corrigem problemas de alinhamento dos dentes e da mandíbula, melhorando a estética e a função da mordida, além de contribuir para a saúde bucal a longo prazo.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-2c29c7d elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-invisible elementor-widget elementor-widget-pt-accordion" data-id="2c29c7d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInRight&quot;}" data-widget_type="pt-accordion.default">
                            <div class="elementor-widget-container">
                                <div class="pt-accordion ">
                                    <div class="pt-accordion-title">
                                        <span>Como funcionam os implantes dentários?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        Os implantes dentários substituem dentes perdidos. Um pino de titânio é inserido no osso da mandíbula, servindo como base para a prótese dentária. Proporciona uma solução permanente e natural.
                                    </div>
                                    <div class="pt-accordion-title">
                                        <span>O que é clareamento dental e quem pode fazer?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        O clareamento dental é um procedimento estético para branquear os dentes. Pode ser feito por muitos pacientes, mas a avaliação do dentista é essencial para determinar a adequação.
                                    </div>
                                    <div class="pt-accordion-title">
                                        <span>Quais são os sinais de problemas na gengiva?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        Sangramento, inchaço, vermelhidão e sensibilidade podem indicar problemas gengivais. Estes sinais devem ser comunicados ao dentista para uma avaliação completa.
                                    </div>
                                    <div class="pt-accordion-title">
                                        <span>Como lidar com a ansiedade odontológica?</span>
                                    </div>
                                    <div class="pt-accordion-content">
                                        A comunicação aberta com o dentista sobre medos e ansiedades é crucial. Muitas clínicas oferecem abordagens mais suaves e opções de relaxamento para garantir uma experiência mais confortável.
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
                                        <?= form_open('formulario_agenda', 'class="wpcf7-form init" aria-label="Contact form" novalidate="novalidate" data-status="init" id="formulario-agendar-consulta"'); ?>
                                            <div class="row">
                                                <div class="col-12 mb-4 has-chevron">
                                                    <p>
                                                        <label>Selecione uma Unidade*</label><br>
                                                        <span class="wpcf7-form-control-wrap" data-name="menu-405">
                                                            <select class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false" name="menu-405">
                                                                <?php foreach($unidades as $unidade): ?>
                                                                <option value="<?= $unidade->link; ?>"><?= $unidade->nome; ?></option>
                                                                <?php endforeach; ?>
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
                                            <div class="wpcf7-response-output" aria-hidden="true"></div>
                                        <?= form_close(); ?>
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
                                <img loading="lazy" decoding="async" width="996" height="1094" src="<?= base_url(); ?>custom/img/julio7.png" class="attachment-full size-full wp-image-372" alt="" sizes="(max-width: 996px) 100vw, 996px">															
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
            <div class="elementor-element elementor-element-7da0865 e-con-full e-flex e-con e-parent" data-id="7da0865" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-88549c1 e-flex e-con-boxed e-con e-child" data-id="88549c1" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-66a2bf2 e-con-full e-flex elementor-invisible e-con e-child" data-id="66a2bf2" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;}">
                            <div class="elementor-element elementor-element-3766c3b elementor-widget elementor-widget-pt-heading" data-id="3766c3b" data-element_type="widget" data-widget_type="pt-heading.default">
                                <div class="elementor-widget-container">
                                    <div class="pt-heading text-align-center">
                                        <p class="pt-heading-subtitle">Contato</p>
                                        <h2 class="pt-heading-title h2">
                                            Conecte-se Conosco para um Sorriso Saudável
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-623c02e e-con-full e-flex e-con e-child" data-id="623c02e" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                <div class="elementor-element elementor-element-1e265b8 e-con-full e-flex e-con e-child" data-id="1e265b8" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                    <div class="elementor-element elementor-element-12899f0 elementor-widget elementor-widget-google_maps" data-id="12899f0" data-element_type="widget" data-widget_type="google_maps.default">
                                        <div class="elementor-widget-container">
                                            <style>/*! elementor - v3.18.0 - 20-12-2023 */
                                                .elementor-widget-google_maps .elementor-widget-container{overflow:hidden}.elementor-widget-google_maps .elementor-custom-embed{line-height:0}.elementor-widget-google_maps iframe{height:300px}
                                            </style>
                                            <div class="elementor-custom-embed">
                                                <iframe loading="lazy" src="https://maps.google.com/maps?q=bdente&t=m&z=16&output=embed&iwloc=near" title="Bdente" aria-label="Bdente"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-a5340c8 e-con-full e-flex e-con e-child" data-id="a5340c8" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;classic&quot;,&quot;position&quot;:&quot;absolute&quot;}">
                                        <div class="elementor-element elementor-element-67fc816 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="67fc816" data-element_type="widget" data-widget_type="icon-box.default">
                                            <div class="elementor-widget-container">
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
                                                            <?= $unidades[0]->endereco; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-08aae97 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="08aae97" data-element_type="widget" data-widget_type="icon-box.default">
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
                                                            <?= $unidades[0]->email; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-aa50361 elementor-view-stacked elementor-position-left elementor-vertical-align-middle elementor-mobile-position-left elementor-shape-circle elementor-widget elementor-widget-icon-box" data-id="aa50361" data-element_type="widget" data-widget_type="icon-box.default">
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
                                                            <?= $unidades[0]->telefone; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-12a9f1f e-con-full e-flex e-con e-child" data-id="12a9f1f" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                                    <div class="elementor-element elementor-element-cf99f18 e-flex e-con-boxed e-con e-child" data-id="cf99f18" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                                        <div class="e-con-inner">
                                            <div class="elementor-element elementor-element-8c339a1 elementor-widget elementor-widget-pt-heading" data-id="8c339a1" data-element_type="widget" data-widget_type="pt-heading.default">
                                                <div class="elementor-widget-container">
                                                    <div class="pt-heading text-align-">
                                                        <h3 class="pt-heading-title h3">
                                                            Horário de atendimento
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-01d9f51 e-flex e-con-boxed e-con e-child" data-id="01d9f51" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-d0e5b61 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="d0e5b61" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>Segunda</p>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-9d8d811 elementor-widget elementor-widget-text-editor" data-id="9d8d811" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>08:00 - 18:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-481a50f elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="481a50f" data-element_type="widget" data-widget_type="divider.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-divider">
                                                        <span class="elementor-divider-separator">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-406e296 e-flex e-con-boxed e-con e-child" data-id="406e296" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-7da202f elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="7da202f" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>Terça</p>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-7f1b3a8 elementor-widget elementor-widget-text-editor" data-id="7f1b3a8" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>08:00 - 18:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-2033c29 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="2033c29" data-element_type="widget" data-widget_type="divider.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-divider">
                                                        <span class="elementor-divider-separator">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-71fc9d4 e-flex e-con-boxed e-con e-child" data-id="71fc9d4" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-d1a9a36 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="d1a9a36" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>Quarta</p>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-36f8ef2 elementor-widget elementor-widget-text-editor" data-id="36f8ef2" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>08:00 - 18:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-632ea90 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="632ea90" data-element_type="widget" data-widget_type="divider.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-divider">
                                                        <span class="elementor-divider-separator">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-1bad97e e-flex e-con-boxed e-con e-child" data-id="1bad97e" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-55c7032 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="55c7032" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>Quinta</p>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-0eca508 elementor-widget elementor-widget-text-editor" data-id="0eca508" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>08:00 - 18:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-7b6524c elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="7b6524c" data-element_type="widget" data-widget_type="divider.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-divider">
                                                        <span class="elementor-divider-separator">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-45248a3 e-flex e-con-boxed e-con e-child" data-id="45248a3" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-9f64071 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="9f64071" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>Sexta</p>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-17badb9 elementor-widget elementor-widget-text-editor" data-id="17badb9" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>08:00 - 18:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-be5ea75 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="be5ea75" data-element_type="widget" data-widget_type="divider.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-divider">
                                                        <span class="elementor-divider-separator">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-f3f7423 e-flex e-con-boxed e-con e-child" data-id="f3f7423" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;boxed&quot;}">
                                                <div class="e-con-inner">
                                                    <div class="elementor-element elementor-element-9120a73 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="9120a73" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>Sábado</p>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-22f7de8 elementor-widget elementor-widget-text-editor" data-id="22f7de8" data-element_type="widget" data-widget_type="text-editor.default">
                                                        <div class="elementor-widget-container">
                                                            <p>08:00 - 12:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-1fdea26 e-flex e-con-boxed e-con e-child" data-id="1fdea26" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                                        <div class="e-con-inner">
                                            <div class="elementor-element elementor-element-636eafa elementor-widget elementor-widget-pt-heading" data-id="636eafa" data-element_type="widget" data-widget_type="pt-heading.default">
                                                <div class="elementor-widget-container">
                                                    <div class="pt-heading text-align-">
                                                        <h5 class="pt-heading-title h5">
                                                            Mais informações sobre nossos tratamentos?				
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-c382422 elementor-widget elementor-widget-pt-button" data-id="c382422" data-element_type="widget" data-widget_type="pt-button.default">
                                                <div class="elementor-widget-container">
                                                    <a class="pt-button filled " href="#container-agendar-consulta">
                                                    <span>Agende uma avaliação</span>
                                                    <i aria-hidden="true" class="pticon pticon-arrow-right"></i>		</a>
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
            <div class="elementor-element elementor-element-357208d e-con-full e-flex e-con e-parent" data-id="357208d" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}" data-core-v316-plus="true">
                <div class="elementor-element elementor-element-2c57750 e-flex e-con-boxed e-con e-child" data-id="2c57750" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1096821 e-con-full e-flex e-con e-child" data-id="1096821" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;}">
                            <div class="elementor-element elementor-element-b4d81f1 elementor-widget elementor-widget-pt-heading" data-id="b4d81f1" data-element_type="widget" data-widget_type="pt-heading.default">
                                <div class="elementor-widget-container">
                                    <div class="pt-heading text-align-">
                                        <p class="pt-heading-subtitle">Newsletter</p>
                                        <h2 class="pt-heading-title h2">
                                            Receba novidades e informações
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-bf8ad8a elementor-widget__width-initial elementor-widget elementor-widget-pt-mailchimp" data-id="bf8ad8a" data-element_type="widget" data-widget_type="pt-mailchimp.default">
                                <div class="elementor-widget-container">
                                    <div class="pt-mailchimp">
                                        <form action="#" id="mc4wp-form-1" class="mc4wp-form mc4wp-form-233" method="post" data-id="233" data-name="Form 1">
                                            <div class="mc4wp-form-fields">
                                                <input type="email" name="email" id="your-email" placeholder="Seu melhor email" required="">
                                                <input type="submit" value="Subscribe" class="pt-button filled">
                                            </div>
                                            <label style="display: none !important;">Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off"></label><input type="hidden" name="_mc4wp_timestamp" value="1704856797"><input type="hidden" name="_mc4wp_form_id" value="233"><input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1">
                                            <div class="mc4wp-response"></div>
                                        </form>
                                        <!-- / Mailchimp for WordPress Plugin -->		
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-83e51de elementor-absolute elementor-widget elementor-widget-image" data-id="83e51de" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <img loading="lazy" decoding="async" width="1166" height="730" src="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-14.webp" class="attachment-full size-full wp-image-383" alt="" srcset="<?= base_url(); ?>wp-content/uploads/2023/12/densmi-14.webp 1166w, <?= base_url(); ?>wp-content/uploads/2023/12/densmi-14-1080x676.webp 1080w, <?= base_url(); ?>wp-content/uploads/2023/12/densmi-14-300x188.webp 300w, <?= base_url(); ?>wp-content/uploads/2023/12/densmi-14-1024x641.webp 1024w, <?= base_url(); ?>wp-content/uploads/2023/12/densmi-14-768x481.webp 768w" sizes="(max-width: 1166px) 100vw, 1166px">															
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
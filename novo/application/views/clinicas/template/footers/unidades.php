<script>
    if(localStorage.getItem('projectImage') && document.querySelector('body').classList.contains('single-pt-portfolio')) {
      let params = JSON.parse(localStorage.getItem('projectImage')),
      block = document.createElement("div"),
      scrollWrap = document.querySelector('.main-smooth-scroll');

      scrollWrap.style.pointerEvents = 'none';

      block.classList.add('project-image')
      block.style.background = 'url(\''+params.base64+'\') 50% no-repeat'
      block.style.backgroundSize = 'cover'
      block.style.position = 'fixed'
      block.style.width = params.width+'px'
      block.style.height = params.height+'px'
      block.style.top = params.top+'px'
      block.style.left = params.left+'px'
      block.style.zIndex = '1050'

      document.querySelector('body').insertBefore(block, document.body.firstChild);
    }
</script>
<script type="text/javascript">
    (function () {
        var c = document.body.className;
        c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
        document.body.className = c;
    })();
</script>
<link rel='stylesheet' id='ypromo-inline-css' href='<?= base_url(); ?>wp-content/themes/densmi/css/custom.css?ver=6.4.2' media='all'>
<style id='ypromo-inline-inline-css'>
    .site-header.colored { background-color: #F5FAFE; }
</style>
<link rel='stylesheet' id='elementor-post-221-css' href='<?= base_url(); ?>wp-content/uploads/elementor/css/post-221.css?ver=1704631618' media='all'>
<link rel='stylesheet' id='elementor-post-1004-css' href='<?= base_url(); ?>wp-content/uploads/elementor/css/post-1004.css?ver=1704645609' media='all'>
<link rel='stylesheet' id='elementor-post-1023-css' href='<?= base_url(); ?>wp-content/uploads/elementor/css/post-1023.css?ver=1704645635' media='all'>
<link rel='stylesheet' id='elementor-post-230-css' href='<?= base_url(); ?>wp-content/uploads/elementor/css/post-230.css?ver=1704631820' media='all'>
<script src="<?= base_url(); ?>wp-content/plugins/contact-form-7/includes/swv/js/index.js?ver=5.8.5" id="swv-js"></script>
<script id="contact-form-7-js-extra">
    var wpcf7 = {"api":{"root":"https:wp-json\/","namespace":"contact-form-7\/v1"},"cached":"1"};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/contact-form-7/includes/js/index.js?ver=5.8.5" id="contact-form-7-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/date-time-picker-for-contact-form-7/assets/js/jquery.datetimepicker.full.min.js?ver=6.4.2" id="walcf7-datepicker-js-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/date-time-picker-for-contact-form-7/assets/js/datetimepicker.js?ver=1.0.0" id="walcf7-datepicker-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/assets/js/gsap.min.js?ver=3.4.2" id="gsap-js"></script>
<script id="popup-js-js-extra">
    var yprm_popup_vars = {"likes":"likes","like":"like","view_project":"view project","popup_arrows":"show","popup_counter":"show","popup_back_to_grid":"show","popup_fullscreen":"show","popup_autoplay":"show","popup_share":"show","popup_likes":"show","popup_project_link":"show","popup_image_title":"hide","popup_image_desc":"hide"};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/include/popup/script.js?ver=1.0.0" id="popup-js-js"></script>
<script src="<?= base_url(); ?>wp-content/themes/densmi/js/scripts.js" id="yprm-scripts-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/assets/js/pt-scripts.js?ver=1.0.0" id="pt-scripts-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/imagesloaded.min.js?ver=5.0.0" id="imagesloaded-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/assets/js/isotope.pkgd.min.js?ver=3.0.6" id="isotope-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/assets/js/swiper.min.js?ver=8.3.2" id="swiper-js"></script>
<script id="pt-load-more-js-extra">
    var yprm_ajax = {"url":"https:wp-admin\/admin-ajax.php","home_url":"https:"};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/assets/js/load-more.js?ver=1.0.0" id="pt-load-more-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.18.3" id="elementor-webpack-runtime-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.18.3" id="elementor-frontend-modules-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/jquery/ui/core.min.js?ver=1.13.2" id="jquery-ui-core-js"></script>
<script id="elementor-frontend-js-before">
    var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselWrapperAriaLabel":"Carousel | Horizontal scrolling: Arrow Left & Right","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.18.3","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"e_optimized_assets_loading":true,"e_optimized_css_loading":true,"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_swiper_latest":true,"theme_builder_v2":true,"block_editor_assets_optimize":true,"landing-pages":true,"nested-elements":true,"e_image_loading_optimization":true,"e_global_styleguide":true,"page-transitions":true,"notes":true,"form-submissions":true,"e_scroll_snap":true},"urls":{"assets":"https:wp-content\/plugins\/elementor\/assets\/"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description","woocommerce_notices_elements":[]},"post":{"id":23,"title":"Densmi%20%E2%80%93%20Dental%20Clinic%20WordPress%20Theme","excerpt":"","featuredImage":false}};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.18.3" id="elementor-frontend-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/blog.js?ver=6.4.2" id="pt-blog-handler-js"></script>
<script id="wc-cart-fragments-js-extra">
    var wc_cart_fragments_params = {"ajax_url":"\/densmi\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/densmi\/?wc-ajax=%%endpoint%%","cart_hash_key":"wc_cart_hash_bf5099f7101b55948b3bdac92daddef5","fragment_name":"wc_fragments_bf5099f7101b55948b3bdac92daddef5","request_timeout":"5000"};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=8.4.0" id="wc-cart-fragments-js" defer="" data-wp-strategy="defer"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/slider.js?ver=6.4.2" id="pt-slider-handler-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/brands.js?ver=6.4.2" id="pt-brands-handler-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/jquery/ui/accordion.min.js?ver=1.13.2" id="jquery-ui-accordion-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/accordion.js?ver=6.4.2" id="pt-accordion-handler-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/assets/js/items-animation.js?ver=0.0.1" id="items-animation-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/portfolio.js?ver=6.4.2" id="portfolio-handler-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/testimonials.js?ver=6.4.2" id="pt-testimonials-handler-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/team.js?ver=6.4.2" id="pt-team-handler-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/products.js?ver=6.4.2" id="products-handler-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pt-densmi-addons/elementor/js/products-carousel.js?ver=6.4.2" id="products-carousel-handler-js"></script>
<script defer="" src="<?= base_url(); ?>wp-content/plugins/mailchimp-for-wp/assets/js/forms.js?ver=4.9.10" id="mc4wp-forms-api-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pro-elements/assets/js/webpack-pro.runtime.min.js?ver=3.18.1" id="elementor-pro-webpack-runtime-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2" id="wp-polyfill-inert-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/dist/vendor/regenerator-runtime.min.js?ver=0.14.0" id="regenerator-runtime-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0" id="wp-polyfill-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/dist/hooks.min.js?ver=c6aec9a8d4e5a5d543a1" id="wp-hooks-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/dist/i18n.min.js?ver=7701b0c3857f914212ef" id="wp-i18n-js"></script>
<script id="wp-i18n-js-after">
    wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
</script>
<script id="elementor-pro-frontend-js-before">
    var ElementorProFrontendConfig = {"ajaxurl":"https:wp-admin\/admin-ajax.php","nonce":"eb419eae0f","urls":{"assets":"https:wp-content\/plugins\/pro-elements\/assets\/","rest":"https:wp-json\/"},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"}},"woocommerce":{"menu_cart":{"cart_page_url":"https:cart\/","checkout_page_url":"https:checkout\/","fragments_nonce":"95d6e2c683"}},"facebook_sdk":{"lang":"en_US","app_id":""},"lottie":{"defaultAnimationUrl":"https:wp-content\/plugins\/pro-elements\/modules\/lottie\/assets\/animations\/default.json"}};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/pro-elements/assets/js/frontend.min.js?ver=3.18.1" id="elementor-pro-frontend-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/pro-elements/assets/js/elements-handlers.min.js?ver=3.18.1" id="pro-elements-handlers-js"></script>
<script src="<?= base_url(); ?>wp-includes/js/underscore.min.js?ver=1.13.4" id="underscore-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/mp-timetable/media/js/mptt-functions.min.js?ver=2.4.9" id="mptt-functions-js"></script>
<script id="mptt-event-object-js-extra">
    var MPTT = {"table_class":"mptt-shortcode-table"};
</script>
<script src="<?= base_url(); ?>wp-content/plugins/mp-timetable/media/js/events/event.min.js?ver=2.4.9" id="mptt-event-object-js"></script>
<script src="<?= base_url(); ?>wp-content/plugins/mp-timetable/media/js/mptt-elementor-editor.min.js?ver=2.4.9" id="mptt-editor-panel-js-js"></script>
<script src="<?= base_url(); ?>custom/js/custom.js"></script>
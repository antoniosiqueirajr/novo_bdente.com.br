<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$suggestion_link = 'https://elemailer.com/';
?>
<script type="text/template" id="tmpl-elemailer-template-base-skeleton">
    <div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox" id="elemailer-modal">
        <div class="dialog-widget-content dialog-lightbox-widget-content">
            <div class="elemailer-content-wrap" data-page="1">
                <div class="elemailer-template-library-toolbar">
                    <div class="elementor-template-library-filter-toolbar">
                        <div class="elementor-template-library-order">
                            <select class="elementor-template-library-order-input elementor-template-library-filter-select elementor-select2">
                                <option value=""><?php esc_html_e( 'All', 'elemailer' ); ?></option>
                                <option value="free"><?php esc_html_e( 'Free', 'elemailer' ); ?></option>
                                <option value="premium"><?php esc_html_e( 'Premium', 'elemailer' ); ?></option>
                            </select>
                        </div>
                        <div class="elemailer-blocks-filter-inner-wrap"  id="elementor-template-block-color-filter" style="display: none;"></div>
                    </div>
                    <div class="elemailer-template-library-filter-text-wrapper">
                        <label for="elementor-template-library-filter-text" class="elementor-screen-only"><?php esc_html_e( 'Search...', 'elemailer' ); ?></label>
                        <input id="wp-filter-search-input" placeholder="<?php esc_html_e( 'SEARCH', 'elemailer' ); ?>" class="">
                        <i class="eicon-search"></i>
                    </div>
                </div>
                <div id="elemailer-floating-notice-wrap-id" class="elemailer-floating-notice-wrap"><div class="elemailer-floating-notice"></div></div>
                <div class="dialog-message dialog-lightbox-message" data-type="pages">
                    <div class="dialog-content dialog-lightbox-content theme-browser"></div>
                    <div class="theme-preview"></div>
                        <div class="dialog-loading dialog-lightbox-loading" >
                            <div id="elementor-template-library-loading">
                            <div class="elementor-loader-wrapper">
                                <div class="elementor-loader">
                                    <div class="elementor-loader-boxes">
                                        <div class="elementor-loader-box"></div>
                                        <div class="elementor-loader-box"></div>
                                        <div class="elementor-loader-box"></div>
                                        <div class="elementor-loader-box"></div>
                                    </div>
                                    </div>
                                    <div class="elementor-loading-title">Loading</div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="dialog-message dialog-lightbox-message-my-templates" data-type="my_templates">
                    <div class="dialog-content dialog-lightbox-content-my-templates" data-my-templates-page="1"></div>
                    <div class="theme-preview-my-templates"></div>
                        <div class="dialog-loading dialog-lightbox-loading" >
                                <div id="elementor-template-library-loading">
                                <div class="elementor-loader-wrapper">
                                    <div class="elementor-loader">
                                        <div class="elementor-loader-boxes">
                                            <div class="elementor-loader-box"></div>
                                            <div class="elementor-loader-box"></div>
                                            <div class="elementor-loader-box"></div>
                                            <div class="elementor-loader-box"></div>
                                        </div>
                                        </div>
                                        <div class="elementor-loading-title">Loading</div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="elemailer-loading-wrap"><div class="elemailer-loading-icon"></div></div>
            </div>
            <div class="dialog-buttons-wrapper dialog-lightbox-buttons-wrapper"></div>
        </div>
        <div class="dialog-background-lightbox"></div>
    </div>
</script>

<script type="text/template" id="tmpl-elemailer-template-modal__header">
    <div class="dialog-header dialog-lightbox-header">
        <div class="elemailer-modal__header">
            <div class="elemailer-modal__header__logo-area">
                <div class="elemailer-modal__header__logo">
                    <span class="elemailer-modal__header__logo__icon-wrapper"></span>
                </div>
                <div class="back-to-layout" title="<?php esc_html_e( 'Back to Layout', 'elemailer' ); ?>" data-step="1"><span class="dashicons dashicons-arrow-left-alt2"></span></div>
            </div>
            <div class="elementor-templates-modal__header__menu-area elemailer-step-1-wrap elemailer-modal__options">
                <div class="elementor-template-library-header-menu">
                    <div class="elementor-template-library-menu-item elementor-template-library-menu-remote elementor-active" data-template-source="remote" data-template-type="pages"><span class="elemailer-icon-file"></span><?php esc_html_e( 'Template', 'elemailer' ); ?></div>
                    <div class="elementor-template-library-menu-item elementor-template-library-menu-local" data-template-source="local" data-template-type="my_templates"><span class="elemailer-icon-file"></span><?php esc_html_e( 'My Template', 'elemailer' ); ?></div>
                </div>
            </div>
            <div class="elementor-templates-modal__header__items-area">
                <div class="elemailer-modal__header__close elemailer-modal__header__close--normal elemailer-modal__header__item">
                    <i class="dashicons close dashicons-no-alt" aria-hidden="true" title="<?php esc_html_e( 'Close', 'elemailer' ); ?>"></i>
                    <span class="elementor-screen-only"><?php esc_html_e( 'Close', 'elemailer' ); ?></span>
                </div>
                <div class="elemailer__sync-wrap">
                    <div class="elemailer-sync-library-button">
                        <span class="dashicons dashicons-image-rotate" ria-hidden="true" title="<?php esc_html_e( 'Sync Library', 'elemailer' ); ?>"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<?php /* show icon for pro templates */  ?>

<script type="text/template" id="tmpl-elemailer-list"> 
    <#
    var count = 0;
    for ( key in data ) {
    var type_class = ' site-type-' + data[ key ]['site-pages-type'];
    var site_title = data[ key ]['title'].slice( 0, 25 );
    var site_type  = data[ key ]['site-pages-type'];


    if ( '' !== ElemailerElementorAdmin.siteType ) {
    if ( 'free' == ElemailerElementorAdmin.siteType && site_type != 'free' ) {
    continue;
    }

    if ( 'free' != ElemailerElementorAdmin.siteType && site_type == 'free' ) {
    continue;
    }
    }

    if ( data[ key ]['title'].length > 25 ) {
    site_title += '...';
    }
    count++;
    #>
    <div class="theme elemailer-theme site-single publish page-builder-elementor {{type_class}}" data-template-id="{{key}}">
        <div class="inner">
			<span class="site-preview" data-href="" data-title={{site_title}}>
				<div class="theme-screenshot one loading" data-step="1" data-src={{data[ key ]['thumbnail-image-url']}} data-featured-src={{data[ key ]['featured-image-url']}}>
					<div class="elementor-template-library-template-preview">
					   <i class="eicon-zoom-in" aria-hidden="true"></i>
					</div>
        </div>
        </span>
        <div class="theme-id-container">
            <h3 class="theme-name">{{{site_title}}}</h3>
        </div>
        <# if ( site_type && 'free' !== site_type ) { #>
        <?php /* translators: %s are white label strings. */ ?>
        <div class="agency-ribbons" title="<?php printf( esc_attr__( 'This premium template is accessible with %1$s "Premium" Package.', 'elemailer' ), __( 'Elemailer', 'elemailer' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"><img class="premium-crown-icon" src="<?php echo esc_url( ELE_MAILER_PLUGIN_PUBLIC . '/assets/images/premium-crown.svg' ); ?>" alt="premium-crown"><?php esc_html_e( 'Premium', 'elemailer' ); ?></div>
        <# } #>
    </div>
    </div>
    <#
    }
    #>
</script>


<script type="text/template" id="tmpl-elemailer-template-library-template-local">
    <#
    var count = 0;
    for ( key in data ) {
        count++;
    #>

    <#
    }
    #>

    <#
    if ( count != 0 ) {
    #>
    <div id="elementor-template-library-templates" data-template-id="">
        <div id="elementor-template-library-order-toolbar-local">
            <div class="elementor-template-library-local-column-1">
                <input type="radio" id="elementor-template-library-order-local-title" class="elementor-template-library-order-input" name="elementor-template-library-order-local" value="title" data-default-ordering-direction="asc">
                <label for="elementor-template-library-order-local-title" class="elementor-template-library-order-label"><?php echo esc_html__( 'Name', 'elemailer' ); ?></label>
            </div>
            <div class="elementor-template-library-local-column-2">
                <input type="radio" id="elementor-template-library-order-local-type" class="elementor-template-library-order-input" name="elementor-template-library-order-local" value="type" data-default-ordering-direction="asc">
                <label for="elementor-template-library-order-local-type" class="elementor-template-library-order-label"><?php echo esc_html__( 'Type', 'elemailer' ); ?></label>
            </div>
            <div class="elementor-template-library-local-column-3">
                <input type="radio" id="elementor-template-library-order-local-author" class="elementor-template-library-order-input" name="elementor-template-library-order-local" value="author" data-default-ordering-direction="asc">
                <label for="elementor-template-library-order-local-author" class="elementor-template-library-order-label"><?php echo esc_html__( 'Created By', 'elemailer' ); ?></label>
            </div>
            <div class="elementor-template-library-local-column-4">
                <input type="radio" id="elementor-template-library-order-local-date" class="elementor-template-library-order-input" name="elementor-template-library-order-local" value="date">
                <label for="elementor-template-library-order-local-date" class="elementor-template-library-order-label"><?php echo esc_html__( 'Creation Date', 'elemailer' ); ?></label>
            </div>
            <div class="elementor-template-library-local-column-5">
                <div class="elementor-template-library-order-label"><?php echo esc_html__( 'Actions', 'elemailer' ); ?></div>
            </div>
        </div>
    </div>
    <#
    }
    #>

    <#
    if ( count == 0 ) {
    #>
    <div class="elemailer-no-sites">
        <div class="inner">
            <h3><?php esc_html_e( 'No Templates Found.', 'elemailer' ); ?></h3>
        </div>
    </div>
    <#
    }
    #>

    <div id="elemailer-template-library-templates-container">
        <#
        var count = 0;
        for ( key in data ) {
        var id          = data[ key ]['id'];
        var title       = data[ key ]['title'];
        var author      = data[ key ]['author'];
        var preview_url = data[ key ]['preview_url'];
        var date        = data[ key ]['date'];

        count++;
        #>
        <div class="elementor-template-library-template elementor-template-library-template-local">
            <div class="elementor-template-library-template-name elementor-template-library-local-column-1">{{ title }}</div>
            <div class="elementor-template-library-template-meta elementor-template-library-template-type elementor-template-library-local-column-2"><?php echo esc_html__( 'Elemailer', 'elemailer' ); ?></div>
            <div class="elementor-template-library-template-meta elementor-template-library-template-author elementor-template-library-local-column-3">{{{ author }}}</div>
            <div class="elementor-template-library-template-meta elementor-template-library-template-date elementor-template-library-local-column-4">{{{ date }}}</div>
            <div class="elementor-template-library-template-controls elementor-template-library-local-column-5">
                <div class="elementor-template-library-template-preview">
                    <a href="{{ preview_url }}" target="_blank">
                        <i class="eicon-preview-medium" aria-hidden="true"></i>
                        <span class="elementor-template-library-template-control-title"><?php echo esc_html__( 'Preview', 'elemailer' ); ?></span>
                    </a>
                </div>
                <button class="elementor-template-library-template-action elemailer-template-library-template-insert elementor-button elementor-button-success elemailer-library-my-template-insert" data-saved-template-id="{{id}}">
                    <i class="eicon-file-download" aria-hidden="true"></i>
                    <span class="elementor-button-title elemailer_elementor_button_title_label"><?php echo esc_html__( 'Insert', 'elemailer' ); ?></span>
                </button>
                <div class="elementor-template-library-template-delete" data-saved-template-id="{{id}}">
                    <i class="eicon-trash-o" aria-hidden="true"></i>
                    <span class="elementor-template-library-template-control-title"><?php echo esc_html__( 'Delete', 'elemailer' ); ?></span>
                </div>
            </div>
        </div>
        <#
        }
        #>
    </div>
</script>

<script type="text/template" id="tmpl-elemailer-list-search">
    <#
    var count = 0;
    for ( key in data ) {
    var type_class = ' site-type-' + data[ key ]['site-pages-type'];
    var site_title = data[ key ]['title'].slice( 0, 25 );
    var site_type  = data[ key ]['site-pages-type'];
    if ( data[ key ]['title'].length > 25 ) {
    site_title += '...';
    }
    count++;
    #>
    <div class="theme elemailer-theme site-single publish page-builder-elementor {{type_class}}" data-template-id="{{key}}">
        <div class="inner">
			<span class="site-preview" data-href="" data-title="Test Template">
				<div class="theme-screenshot one loading" data-step="1" data-src={{data[ key ]['thumbnail-image-url']}} data-featured-src={{data[ key ]['featured-image-url']}}>
					<div class="elementor-template-library-template-preview">
					   <i class="eicon-zoom-in" aria-hidden="true"></i>
					</div>
        </div>
        </span>
        <div class="theme-id-container">
            <h3 class="theme-name">{{{site_title}}}</h3>
        </div>
        <# if ( site_type && 'free' !== site_type ) { #>
        <?php /* translators: %s are white label strings. */ ?>
        <div class="agency-ribbons" title="<?php printf( esc_attr__( 'This premium template is accessible with %1$s "Premium" Package.', 'elemailer' ), __( 'Elemailer Pro', 'elemailer' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"><img class="premium-crown-icon" src="<?php echo esc_url( ELE_MAILER_PLUGIN_PUBLIC . '/assets/images/premium-crown.svg' ); ?>" alt="premium-crown"><?php esc_html_e( 'Premium', 'elemailer' ); ?></div>
        <# } #>
    </div>
    </div>
    <#
    }
    #>

    if ( count == 0 ) {
    #>
    <div class="elemailer-no-sites">
        <div class="inner">
            <h3><?php esc_html_e( 'Sorry No Results Found.', 'elemailer' ); ?></h3>
            <div class="content">
                <div class="description">
                    <p>
                        <?php
                        /* translators: %1$s External Link */
                        printf( __( 'Don\'t see a template you would like to import?<br><a target="_blank" href="%1$s">Make a Template Suggestion!</a>', 'elemailer' ), esc_url( $suggestion_link ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </p>
                    <div class="back-to-layout-button"><span class="button elemailer-back"><?php esc_html_e( 'Back to Templates', 'elemailer' ); ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <#
    }
    #>
</script>

<script type="text/template" id="tmpl-elemailer-search">

    <#
    var count = 0;

    for ( ind in data ) {

    var site_id = ( undefined == data.site_id ) ? data[ind].site_id : data.site_id;
    var site_type = data[ ind ]['site-pages-type'];

    if ( 'site' == data[ind]['type'] ) {
    site_type = data[ ind ]['site-pages-type'];
    }

    if ( undefined == site_type ) {
    continue;
    }

    var parent_name = '';
    if ( undefined != data[ind]['parent-site-name'] ) {
    var parent_name = $( "<textarea/>") .html( data[ind]['parent-site-name'] ).text();
    }

    var complete_title = parent_name + ' - ' + data[ ind ]['title'];
    var site_title = complete_title.slice( 0, 25 );
    if ( complete_title.length > 25 ) {
    site_title += '...';
    }

    var tmp = site_title.split(' - ');
    var title1 = site_title;
    var title2 = '';
    if ( undefined !== tmp && undefined !== tmp[1] ) {
    title1 = tmp[0];
    title2 = ' - ' + tmp[1];
    } else {
    title1 = tmp[0];
    title2 = '';
    }

    var type_class = ' site-type-' + site_type;
    count++;
    #>
    <div class="theme elemailer-theme site-single publish page-builder-elementor {{type_class}}" data-template-id={{ind}}>
        <div class="inner">
				<span class="site-preview" data-href="" data-title={{title2}}>
					<div class="theme-screenshot one loading" data-type={{data[ind]['type']}} data-step={{data[ind]['step']}} data-show="search" data-src={{data[ ind ]['thumbnail-image-url']}} data-featured-src={{data[ ind ]['featured-image-url']}}></div>
        </span>
        <div class="theme-id-container">
            <h3 class="theme-name"><strong>{{title1}}</strong>{{title2}}</h3>
        </div>
    </div>
    </div>
    <#
    }

    if ( count == 0 ) {
    #>
    <div class="elemailer-no-sites">
        <div class="inner">
            <h3><?php esc_html_e( 'Sorry No Results Found.', 'elemailer' ); ?></h3>
            <div class="content">
                <div class="description">
                    <p>
                        <?php
                        /* translators: %1$s External Link */
                        printf( __( 'Don\'t see a template you would like to import?<br><a target="_blank" href="%1$s">Make a Template Suggestion!</a>', 'elemailer' ), esc_url( $suggestion_link ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </p>
                    <div class="back-to-layout-button"><span class="button elemailer-back"><?php esc_html_e( 'Back to Templates', 'elemailer' ); ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <#
    }
    #>
</script>

<script type="text/template" id="tmpl-elemailer-insert-button">
    <div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item" data-template-id={{data.template_id}} data-site-id={{data.site_id}}>
        <a class="elementor-template-library-template-action elementor-template-library-template-insert elementor-button">
            <i class="eicon-file-download" aria-hidden="true"></i>
            <span class="elementor-button-title"><?php esc_html_e( 'Insert', 'elemailer' ); ?></span>
        </a>

    </div>
</script>


<script type="text/template" id="tmpl-elemailer-no-sites">
    <div class="elemailer-no-sites">
        <div class="inner">
            <h3><?php esc_html_e( 'Sorry No Results Found.', 'elemailer' ); ?></h3>
            <div class="content">
                <div class="description">
                    <p>
                        <?php
                        /* translators: %1$s External Link */
                        printf( __( 'Don\'t see a template you would like to import?<br><a target="_blank" href="%1$s">Make a Template Suggestion!</a>', 'elemailer' ), esc_url( $suggestion_link ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </p>
                    <div class="back-to-layout-button"><span class="button elemailer-back"><?php esc_html_e( 'Back to Templates', 'elemailer' ); ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <#
</script>

<script type="text/template" id="tmpl-elemailer-elementor-preview">
    <#
    let wrap_height = $elementorscope.find( '.elemailer-content-wrap' ).height();
    wrap_height = ( wrap_height - 55 );
    wrap_height = wrap_height + 'px';
    #>
    <div id="elemailer-blocks" class="themes wp-clearfix" data-site-id="{{data.id}}" style="display: block;">
        <div class="single-site-wrap">
            <div class="single-site">
                <div class="single-site-preview-wrap">
                    <div class="single-site-preview" style="max-height: {{wrap_height}};">
                        <img class="theme-screenshot" data-src="" src="{{data['featured-image-url']}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="tmpl-elemailer-elementor-preview-actions">
    <#
    #>
    <div class="elemailer-preview-actions-wrap">
        <div class="elemailer-preview-actions-inner-wrap">
            <div class="elemailer-preview-actions">
                <div class="site-action-buttons-wrap">
                    <div class="elemailer-import-template-action site-action-buttons-right">
                        <div class="elemailer-tooltip"><span class="elemailer-tooltip-icon" data-tip-id="elemailer-tooltip-plugins-settings"><span class="dashicons dashicons-editor-help"></span></span></div>
                        <#
                        var is_free = true;
                        if ( 'pages' == ElemailerElementorAdmin.type ) {
                        if( 'free' !== data['site-pages-type'] && ! elemailerElementorData.license_status ) {
                        is_free = false;
                        }
                        }
                        if( ! is_free ) { #>
                        <a class="button button-hero button-primary" href="{{elemailerElementorData.getProURL}}" target="_blank">{{elemailerElementorData.getProText}}<i class="dashicons dashicons-external"></i></a>
                        <# } else { #>
                        <div type="button" class="button button-hero button-primary elemailer-library-template-insert disabled"><?php esc_html_e( 'Import Template', 'elemailer' ); ?></div>
                        <# } #>
                    </div>
                </div>
            </div>
            <div class="elemailer-tooltip-wrap">
                <div>
                    <div class="elemailer-tooltip-inner-wrap" id="elemailer-tooltip-plugins-settings">
                        <ul class="required-plugins-list"><span class="spinner is-active"></span></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
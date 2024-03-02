<?php

/**
 * gloabl function declaration file
 * @3.5 - updated for email tester
 */

//ajax action to get taxonomies by post type
add_action('wp_ajax_nopriv_elemailer_get_taxonomies', 'elemailer_get_taxonomies');
add_action('wp_ajax_elemailer_get_taxonomies', 'elemailer_get_taxonomies');

function elemailer_get_taxonomies()
{
	// first check if data is being sent and that it is the data we want   
	if (isset($_POST['postTypeNonce'])) {
		if (!wp_verify_nonce($_POST['postTypeNonce'], 'wp_rest')) {
			wp_die('You are not allowed!');
		}
		$post_type = sanitize_text_field(isset($_POST['post_type']) ? $_POST['post_type'] : '');
		$taxonomoies = get_object_taxonomies($post_type, 'names');
		$taxonomy_name = array();
		foreach ($taxonomoies as $taxonomy) {
			$taxonomy_name[] = array('name'    => $taxonomy);
		}
		echo json_encode($taxonomy_name);
		wp_die();
	}
}


// @since v3.5 - test email sending for elemailer
// @Modified in 4.0 - to export template

add_action('wp_ajax_elemailer_send_test_email', 'elemailer_send_test_email');

function elemailer_send_test_email(){
	
    check_ajax_referer( 'elemailer_test_email_nonce', '_ajax_nonce' );

    if ( isset($_POST['action']) && $_POST['action'] == "elemailer_send_test_email" ){
    	
    	if(!is_email($_POST['toemail']) && $_POST['ele_export']!=='elemailer_export' ){
    		echo 'Not a valid Email Address!!';
    		die();
    	}

    	$message = \Elemailer\Helpers\Util::get_template_content($_POST['templateid']);
        $message = \Elemailer\Helpers\Util::get_email_html_template($_POST['templateid'], $message);
		
        // @Modified in 4.0 - to export template
        if($_POST['ele_export']=='elemailer_export'){
        	
        	//we will either upload in the uploads directory or in the plugin folder
        	$upload_dir = wp_upload_dir();	
			if ( wp_mkdir_p( $upload_dir['basedir']. '/elemailer-template/' ) === true )
			{
				$upload_path= $upload_dir['basedir'].'/';
				$download_url= $upload_dir['baseurl'].'/';
			}
			else
			{
				$upload_path= plugin_dir_path( __DIR__ );
				$download_url= plugin_dir_url( __DIR__ );
				wp_mkdir_p(plugin_dir_path( __DIR__ ).'elemailer-template/');
			}

        	//before generating a new exported file, all others are deleted so only one file remains at a time
        	$elemailer_files = glob($upload_path.'elemailer-template/*'); // get all file names, files are stored in /elemailer-template/ folder in either upload path
        	
			foreach($elemailer_files as $file){ // iterate files
			  if(is_file($file)) {
			    unlink($file); // delete file
			  }
			}
			 //save the file...
			$elemailer_rand = rand();//random numbr generated for security purpose
			$elemailer_export_file_name = $upload_path.'elemailer-template/'.$elemailer_rand.'_'.'template.html';
			$fh = fopen($elemailer_export_file_name,"w");
			fwrite($fh,$message);
			fclose($fh);

			echo '<a target="_blank" href='. $download_url.'elemailer-template/'.$elemailer_rand.'_'.'template.html'.' download="'.get_the_title($_POST['templateid']).'">Download Now</a>';

        	die();
        }

		$headers = array('Content-Type: text/html; charset=UTF-8');

        $sent_message = wp_mail($_POST['toemail'],'Test Elemailer Email',$message, $headers);
        
		if ( $sent_message ) {
			echo 'The email was sent';
		} else {
			echo 'The email was not sent!';
		}

        die();
    }

    echo 'An Error occured!';

    die();
}


//ajax action to get terms by category
add_action('wp_ajax_nopriv_elemailer_get_terms', 'elemailer_get_terms');
add_action('wp_ajax_elemailer_get_terms', 'elemailer_get_terms');

function elemailer_get_terms()
{
	// first check if data is being sent and that it is the data we want
	if (isset($_POST['postTypeNonce'])) {
		if (!wp_verify_nonce($_POST['postTypeNonce'], 'wp_rest')) {
			wp_die('You are not allowed!');
		}
		$taxonomy_type = sanitize_text_field(isset($_POST['taxonomy_type']) ? $_POST['taxonomy_type'] : '');
		$term_slug = array();
		$terms =  get_terms(array('taxonomy' => $taxonomy_type));
		foreach ($terms as $term) {
			$id = $term->term_id;
			$name = $term->name;
			$term_slug[] = array(
				'id'    => $id,
				'name'  => $name
			);
		}
		//to process the current post terms           
		$term_slug[] = array('id' => 'current', 'name' => 'Current Post');
		echo json_encode($term_slug);
		wp_die();
	}
}

//ajax action to get terms by category
add_action('wp_ajax_nopriv_elemailer_get_posts', 'elemailer_get_posts');
add_action('wp_ajax_elemailer_get_posts', 'elemailer_get_posts');

function elemailer_get_posts()
{
	// first check if data is being sent and that it is the data we want
	if (isset($_POST['postTypeNonce'])) {
		if (!wp_verify_nonce($_POST['postTypeNonce'], 'wp_rest')) {
			wp_die('You are not allowed!');
		}
		$taxonomy_type = sanitize_text_field(isset($_POST['taxonomy_type']) ? $_POST['taxonomy_type'] : '');
		$post_type = sanitize_text_field(isset($_POST['post_type']) ? $_POST['post_type'] : '');

		$posts = array();
		$obj_terms =  get_terms(array('taxonomy' => $taxonomy_type));
		$terms =  wp_list_pluck($obj_terms, 'slug');

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => 10,
			'no_found_rows'		=> true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy_type,
					'field' => 'slug',
					'terms' => $terms,
				),
			),
		);

		$loop = new WP_Query($args);

		$posts = wp_list_pluck($loop->posts, 'post_title', 'ID');

		wp_reset_query();

		echo json_encode($posts);
		wp_die();
	}
}

function get_elemailer_client_ip() {
	$server_ip_keys = [
		'HTTP_CLIENT_IP',
		'HTTP_X_FORWARDED_FOR',
		'HTTP_X_FORWARDED',
		'HTTP_X_CLUSTER_CLIENT_IP',
		'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED',
		'REMOTE_ADDR',
	];

	foreach ( $server_ip_keys as $key ) {
		if ( isset( $_SERVER[ $key ] ) && filter_var( $_SERVER[ $key ], FILTER_VALIDATE_IP ) ) {
			return $_SERVER[ $key ];
		}
	}

	// If not found any real ip.
	return '127.0.0.1';
}
/**
 * Checks either we're in the edit mode
 *
 * @since 1.0.8
 */
if ( ! function_exists( 'elemailer_is_edit_mode' ) ) :
	function elemailer_is_edit_mode( $post_id = 0 ) {
		return \Elementor\Plugin::$instance->editor->is_edit_mode( $post_id );
	}
endif;

/**
 * Checks either we're in the preview mode
 *
 * @since 1.0.8
 */
if ( ! function_exists( 'elemailer_is_preview_mode' ) ) :
	function elemailer_is_preview_mode( $post_id = 0 ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return false;
		}

		if ( ! isset( $_GET['preview_id'] ) || $post_id !== (int) $_GET['preview_id'] ) {
			return false;
		}

		return true;
	}
endif;

/**
 * Checks either we're in the live mode
 *
 * @since 1.0.8
 */
if ( ! function_exists( 'elemailer_is_live_mode' ) ) :
	function elemailer_is_live_mode( $post_id = 0 ) {
		return ! elemailer_is_edit_mode( $post_id ) && ! elemailer_is_preview_mode( $post_id );
	}
endif;

/**
 * Gets a random order ID
 *
 * @since 1.0.8
 * 
 * @return int
 */
if	( ! function_exists( 'elemailer_get_random_order_id' ) ) :
	function elemailer_get_random_order_id() {
		if ( ! function_exists( 'WC' ) ) return false;

		$query = new \WC_Order_Query( array(
			'limit' => 1,
			'orderby' => 'rand',
			'order' => 'DESC',
			'return' => 'ids',
		) );
		$orders = $query->get_orders();

		if ( count( $orders ) > 0 ) {
			return $orders[0];
		}

		return false;
	}
endif;

/**
 * Gets a random booking order ID
 *
 * @since 1.0.8
 * 
 * @return int
 */
if	( ! function_exists( 'elemailer_get_random_booking_id' ) ) :
	function elemailer_get_random_booking_id() {
		if ( ! function_exists( 'WC' ) ) return false;

		$args = [
			'post_type'      => 'wc_booking',
			'posts_per_page' => 1,
			'orderby'        => 'rand',
			'order'          => 'DESC',
			'return'         => 'ids',
			'post_status'    => 'published'
		];
		
		$query    = new WP_Query( $args );
		$bookings = $query->posts;

		if ( isset( $bookings[0]->ID ) ) {
			return $bookings[0]->ID;
		}

		return false;
	}
endif;

/**
 * Return list of woocommerce order edit page hooks
 *
 * @since 1.0.8
 *
 * @return boolean
 */
if ( ! function_exists( 'elemailer_get_current_order_id' ) ) :
	function elemailer_get_current_order_id() {
		global $wp_query;
	
		$post_id = get_the_ID();
		if( get_transient( 'elemailer_wc_email_order_id' ) )
			return get_transient( 'elemailer_wc_email_order_id' );
		if ( get_post_type( $post_id ) == 'shop_order' ) {    	
			return $post_id;		
		} else if ( isset( $wp_query->query ) && isset( $wp_query->query['order-received'] ) ) {
			return $wp_query->query['order-received'];
		} else if ( is_user_logged_in() ) {
			//var_dump($_GET['post']);
			if( isset($_GET['post'] ) ) 
				return $_GET['post'][0];
			$customer 	= new \WC_Customer( get_current_user_id() );
			$last_order = $customer->get_last_order();
	
			if ( is_a( $last_order, 'WC_Order' ) ) {
				return $last_order->get_id();
			}
			return false;
		} else {
			return elemailer_get_guest_order_id();
		}
		
		return false;
	}
endif;

/**
 * Return last order id for guest author
 *
 * @since x.x.x
 *
 * @return boolean
 */
if ( ! function_exists( 'elemailer_get_guest_order_id' ) ) :
	function elemailer_get_guest_order_id() {
		global $wpdb;

		$statuses = array_keys( wc_get_order_statuses() );
		$statuses = implode( "','", $statuses );
	
		// Getting last Order ID (max value)
		$results = $wpdb->get_col( "
			SELECT MAX(ID) FROM {$wpdb->prefix}posts
			WHERE post_type LIKE 'shop_order'
			AND post_status IN ('$statuses')
		" );

		return reset( $results );
	}
endif;

/**
 * Return list of woocommerce booking edit page hooks
 *
 * @since 1.0.8
 *
 * @return boolean
 */
if ( ! function_exists( 'elemailer_get_current_booking_ids' ) ) :
	function elemailer_get_current_booking_ids( $order_id ) {
		global $wpdb;

		$order_ids = wp_parse_id_list( is_array( $order_id ) ? $order_id : array( $order_id ) );
		return wp_parse_id_list( $wpdb->get_col( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'wc_booking' AND post_parent IN (" . implode( ',', array_map( 'esc_sql', $order_ids ) ) . ');' ) );
	}
endif;


/**
 * Return list of woocommerce order edit page hooks
 *
 * @since 1.0.8
 * 
 * @return string
 */
if ( ! function_exists( 'elemailer_get_template_css' ) ) :
	function elemailer_get_template_css( $template_id ) {
		$css_files = [];
		$css_files[] = trailingslashit( ELEMENTOR_ASSETS_URL ) . 'css/frontend.min.css';
		$css_files[] = trailingslashit( ELEMENTOR_ASSETS_URL ) . 'css/common.min.css';
		$css_files[] = trailingslashit( ELEMENTOR_ASSETS_URL ) . 'lib/font-awesome/css/font-awesome.min.css';
		$css_files[] = trailingslashit( ELEMENTOR_ASSETS_URL ) . 'lib/eicons/css/elementor-icons.min.css';
		$css_files[] = trailingslashit( ELEMENTOR_ASSETS_URL ) . 'lib/font-awesome/css/solid.min.css';
		$css_files[] = trailingslashit( ELEMENTOR_ASSETS_URL ) . 'lib/font-awesome/css/brands.min.css';
	
		global $wp_styles;
		foreach( $wp_styles->queue as $_style ) :
			$css_files[] = $wp_styles->registered[ $_style ]->src;
		endforeach;
	
		$css = '';
		foreach ( $css_files as $css_file ) {
			if( strpos( $css_file, 'admin-bar.min.css' ) == false ) {
				if ( file_exists( $css_file ) ) {
					$css .= file_get_contents( $css_file );
				}
			}
		}
	
		$css .= str_replace( 'display:flex', 'display:flex; width:100%', $css );
	
		// some common error fix
		//$css .= ".elementor-widget-container{width:100%;}table {border-spacing: 0;border-collapse: collapse;width:100%}table td{width:200px;padding:10px; border: 1px solid #000}";
		$css .= ".elementor-widget-container{width:100%;}table {border-spacing: 0;border-collapse: collapse;width:100%}";
	
		// rewrite post css stuff
		$upload_dir = wp_get_upload_dir();

		if ( file_exists( "{$upload_dir['basedir']}/elementor/css/post-{$template_id}.css" ) ) {
			$post_css = file_get_contents( "{$upload_dir['basedir']}/elementor/css/post-{$template_id}.css" );
			$post_css = preg_replace( '/@media\(min-width:\d+px\)\{/', '', $post_css );
			$post_css = str_replace( '}}', '}', $post_css );
			$css .= $post_css;
		}
	
		return $css;
	}
endif;

/**
 * Return list of woocommerce emails list.
 *
 * @since 1.0.8
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_get_wc_email_types' ) ) :
	function elemailer_get_wc_email_types() {
		$email_types = apply_filters(
			'elemailer_get_wc_email_types',
			[
				'admin-new-order'           => __( 'New Order', 'elemailer' ),
				'admin-cancelled-order'     => __( 'Cancelled Order', 'elemailer' ),
				'admin-failed-order'        => __( 'Failed Order', 'elemailer' ),
				'customer-completed-order'  => __( 'Completed Order', 'elemailer' ),
				'customer-on-hold-order'    => __( 'Onhold Order', 'elemailer' ),
				'customer-refunded-order'   => __( 'Refunded Order', 'elemailer' ),
				'customer-processing-order' => __( 'Processing Order', 'elemailer' ),
				'customer-note'             => __( 'Note', 'elemailer' ),
				'customer-reset-password'   => __( 'Reset Password', 'elemailer' ),
				'customer-new-account'      => __( 'New Account', 'elemailer' ),
				'customer-invoice-paid'     => __( 'Customer invoice/Order details- Paid', 'elemailer' ),
				'customer-invoice'      	=> __( 'Customer invoice/Order details- Unpaid', 'elemailer' ),
			]
		);

		if ( elemailer_has_wc_booking() ) {
			$booking_emails_types = apply_filters(
				'elemailer_get_wc_booking_email_types',
				[
					'admin-new-booking'                     => __( 'New booking', 'elemailer' ),
					'admin-booking-cancelled'               => __( 'Booking Cancelled', 'elemailer' ),
					'customer-booking-cancelled'            => __( 'Customer Booking Cancelled', 'elemailer' ),
					'customer-booking-confirmed'            => __( 'Customer Booking Confirmed', 'elemailer' ),
					'customer-booking-notification'         => __( 'Customer Booking Notification', 'elemailer' ),
					'customer-booking-pending-confirmation' => __( 'Customer Booking Pending Confirmation', 'elemailer' ),
					'customer-booking-reminder'             => __( 'Customer Booking Reminder', 'elemailer' ),
				]
			);

			$email_types = array_merge( $email_types, $booking_emails_types );
		}
	
		return $email_types;
	}
endif;

/**
 * Return list of woocommerce emails where apply list.
 *
 * @since 1.0.8
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_get_wc_email_where_apply' ) ) :
	function elemailer_get_wc_email_where_apply() {
		$email_types = apply_filters(
			'elemailer_get_wc_email_where_apply',
			[
				'global'   => __( 'Global (All Products)', 'elemailer' ),
				'category' => __( 'Specific Category', 'elemailer' ),
				'product'  => __( 'Specific Product', 'elemailer' ),
			]
		);
	
		return $email_types;
	}
endif;

/**
 * Return list of woocommerce products list.
 *
 * @since 1.0.8
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_get_wc_all_products' ) ) :
	function elemailer_get_wc_all_products() {
		$args = apply_filters(
			'elemailer_get_wc_all_products_args',
			[
				'return'  => 'ids',
				'orderby' => 'name',
				'order'   => 'ASC',
				'status'  => 'publish',
				'limit'   => -1,
			]
		);

		return apply_filters(
			'elemailer_get_wc_all_products',
			wc_get_products( $args )
		);
	}
endif;

/**
 * Return list of woocommerce categories list.
 *
 * @since 1.0.8
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_get_wc_all_categories' ) ) :
	function elemailer_get_wc_all_categories() {
		$args = apply_filters(
			'elemailer_get_wc_all_categories_args',
			[
				'taxonomy'     => 'product_cat',
				'orderby'      => 'name',
				'show_count'   => 1,
				'pad_counts'   => 0,
				'hierarchical' => 1,
				'hide_empty'   => 0,
			]
		);
		
		return apply_filters(
			'elemailer_get_wc_all_categories',
			get_categories( $args )
		);
	}
endif;

/**
 * Return true or false has woocommerce.
 *
 * @since 1.0.8
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_has_woocommerce' ) ) :
	function elemailer_has_woocommerce() {
		return class_exists( 'WooCommerce' );
	}
endif;

/**
 * Return true or false has woocommerce booking.
 *
 * @since x.x.x
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_has_wc_booking' ) ) :
	function elemailer_has_wc_booking() {
		return class_exists( 'WC_Bookings' );
	}
endif;

/**
 * Elemailer detect csv delimiter
 *
 * @since x.x.x
 *
 * @return array
 */
if ( ! function_exists( 'elemailer_detect_csv_delimiter' ) ) :
	function elemailer_detect_csv_delimiter( $csvFile ) {
		$delimiters = [ ";" => 0, "," => 0, "\t" => 0, "|" => 0 ];
		$handle     = fopen( $csvFile, "r" );
		$firstLine  = fgets( $handle );
		
		fclose( $handle ); 
		
		foreach ( $delimiters as $delimiter => &$count ) {
			$count = count( str_getcsv( $firstLine, $delimiter ) );
		}

		return array_search( max( $delimiters ), $delimiters );
	}
endif;



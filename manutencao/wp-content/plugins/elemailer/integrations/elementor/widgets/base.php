<?php

namespace Elemailer\Integrations\Elementor\Widgets;

defined('ABSPATH') || exit;

/**
 * base class for widgets class
 * used to load all widget
 *
 * @author elEmailer 
 * @since 1.0.0
 */
class Base
{
	use \Elemailer\Traits\Singleton;

	/**
	 * initialization function of this class
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function init()
	{

		// register category hook for elementor editor
		add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

		// register widgets hook for elementor editor
		add_action('elementor/widgets/register', [$this, 'on_widgets_registered'],100);

		//register replace shortcode method directly for elemailer
		add_action('elementor/widget/render_content', [$this, 'elemailer_content_shortcode_changing_method']);
	}

	/**
	 * get all widget list of this plugin function
	 *
	 * @since 1.0.0
	 */
	public function get_all_widgets()
	{

		$all_widgets = [
			'free' => [
				'heading',
				'image',
				'image-box',
				'video',
				'button',
				'divider',
				'spacer',
				'text-editor',
				'social',
				'shortcode',
				'latest-posts',
				'selected-posts',
				'footer',
				'html',
				'wc-header',
				'wc-footer',
				'wc-item-details',
				'wc-billing-address',
				'wc-shipping-address',
				'wc-description',
				'wc-customer-notes',
				'wc-order-notes',
				'wc-booking-item-details',
				'wc-new-accouont',
				'wc-order-meta',
			],
		];

		return apply_filters('elemailer/onload/include_widgets', $all_widgets);
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered()
	{		
		$this->remove_widgets();	// remove all widget before registaring our own widgets hookd with 100 delay
		$this->includes();		// include all php files
		$this->register_widget();  // our widget functions
		
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes()
	{

		$all_widgets = $this->get_all_widgets();

		$includes = (is_array($all_widgets['free']) ? $all_widgets['free'] : []);

		foreach ($includes as $widget) {
			require_once ELE_MAILER_PLUGIN_DIR . 'integrations/elementor/widgets/' . $widget . '/' . $widget . '.php';
		}
	}

	private function remove_widgets(){
		if(!in_array( get_post_type(), ['em-form-template', 'em-emails-template'] ) ){
            return;
        } 

		$all_widgets_config=\Elementor\Plugin::instance()->widgets_manager->get_widget_types();
		
		$all_widget_names=array_keys($all_widgets_config);

		//unset($all_widget_names['common']);

		foreach($all_widget_names as $name){

			if($name=='common'){

			}else{
				\Elementor\Plugin::instance()->widgets_manager->unregister($name);
			}		
		}
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget()
	{
		//this is where we create objects for each widget the above  ->use voidquery\Widgets\Hello_World; is needed
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Heading());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Image());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Video());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Button());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Divider());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Spacer());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Text_Editor());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Image_Box());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Social());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Shortcode());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Latest_Posts());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Selected_Posts());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_Footer());
		\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_HTML());

		if ( elemailer_has_woocommerce() ) {
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Header());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Footer());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Item_Details());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Billing_Address());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Shipping_Address());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Description());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_New_Account());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Customer_Notes());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Order_Notes());
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Order_Meta());
		}

		if ( elemailer_has_wc_booking() ) {
			\Elementor\Plugin::instance()->widgets_manager->register(new Elemailer_Widget_WC_Booking_Item_Details());
		}
	}

	/**
	 * create category for our widget on elementor editor panel
	 *
	 * @param object $elements_manager
	 * @return void
	 * @since 1.0.0
	 */
	function add_elementor_widget_categories($elements_manager)
	{

		$elements_manager->add_category(
			'elemailer-template-builder-fields',
			[
				'title' => __('Elemailer Email Builder Fields', 'elemailer'),
				'icon' => 'eicon-mail',
			]
		);
	}


	/**
	 * Internal shortcode parser for elemailer
	 *
	 * @param $order_obj, $string - to replace, $get_keys=false - get only key names
	 * @return void
	 * @since 1.0.0
	 */


	public static function elemailer_internal_smart_tag_parser( $order_obj, $string, $get_keys=false){

		if (function_exists( 'WC' ) && !$order_obj ){
			$order_id = elemailer_is_edit_mode() || elemailer_is_preview_mode() ? elemailer_get_random_order_id() : elemailer_get_current_order_id();
			$order_obj 	  = wc_get_order( $order_id );

			if ( elemailer_is_edit_mode() || elemailer_is_preview_mode() ) {
            	$user_id = get_current_user_id();
            	$user 	 = new \WP_User( $user_id );
	        }
	        else if(!empty($_POST['user_login']) && !empty($_POST['wc_reset_password']) ){  //for reset password we need email id
	            $user    = get_user_by('email',$_POST['user_login']);
	            $user_id = $user->ID;
	        }
	        else {
	            $user_id = get_transient( 'elemailer_wc_email_new_customer_id' );
	            $user    = new \WP_User( $user_id );
	        }
		}


        $replace_with=[]; // key search for value replace with > marged with default keys
        $default_keys=[]; //editor panel default shortcode list
        $user_array=[];




        if (  !empty($user) && is_object($user) ){

			$key = get_password_reset_key( $user );

			if ( ! is_wp_error( $key ) ) {

				$reset_pass_url= esc_url( add_query_arg( array( 'key' => $key, 'id' => $user_id ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) );

				$action           = 'newaccount';
				$set_password_url = wc_get_account_endpoint_url( 'lost-password' ) . "?action=$action&key=$key&login=" . rawurlencode( $user->user_login );
			} else {
				// Something went wrong while getting the key for new password URL, send customer to the generic password reset.
				$set_password_url = wc_get_account_endpoint_url( 'lost-password' );
				$reset_pass_url= wc_get_account_endpoint_url( 'lost-password' );
			}

        		$user_array=[
			        
			        '%%customer_first_name%%' => $user->first_name,
			        '%%customer_last_name%%' =>  $user->last_name, 
			        '%%customer_display_name%%' => $user->display_name,
			        '%%customer_email%%' =>  $user->user_email, 
			        '%%customer_user_name%%' => $user->user_login,
			        '%%site_url%%' => get_bloginfo( 'url' ),
			        '%%set_password_url%%' => $set_password_url,
			        '%%reset_password_url%%' => $reset_pass_url,
			    ];
        
        }


        // only woo related shortcode replaement here. 
        if ( is_a( $order_obj, 'WC_Order' ) ){

       		$order_data = $order_obj->get_data();

       		$replace_with=[
			        
			        '%%order_id%%' => $order_data['id'],
					'%%order_parent_id%%' => $order_data['parent_id'],
					'%%order_status%%' => $order_data['status'],
					'%%order_currency%%' => $order_data['currency'],
					'%%order_version%%' => $order_data['version'],
					'%%order_payment_method%%' => $order_data['payment_method'],
					'%%order_payment_method_title%%' => $order_data['payment_method_title'],
					'%%order_payment_method%%' => $order_data['payment_method'],
					'%%order_payment_method%%' => $order_data['payment_method'],
					'%%get_checkout_payment_url%%' => $order_obj->get_checkout_payment_url(),

					// Using a formated date ( with php date() function as method)
					'%%order_date_created%%' => $order_data['date_created']->date('Y-m-d H:i:s'),
					'%%order_date_modified%%' => $order_data['date_modified']->date('Y-m-d H:i:s'),

					// different date shortcodes
					'{order_date}' => wc_format_datetime($order_data['date_created']),
					'{order_datetime}' => wc_format_datetime($order_data['date_created'],get_option( 'date_format' ) . ', ' . get_option( 'time_format' )),

					// Using a timestamp ( with php getTimestamp() function as method)
					'%%order_timestamp_created%%' => $order_data['date_created']->getTimestamp(),
					'%%order_timestamp_modified%%' => $order_data['date_modified']->getTimestamp(),

					'%%order_discount_total%%' => $order_data['discount_total'],
					'%%order_discount_tax%%' => $order_data['discount_tax'],
					'%%order_shipping_total%%' => $order_data['shipping_total'],
					'%%order_shipping_tax%%' => $order_data['shipping_tax'],
					'%%order_total%%' => $order_data['total'],
					'%%order_total_tax%%' => $order_data['total_tax'],
					'%%order_customer_id%%' => $order_data['customer_id'], // ... and so on

					//BILLING INFORMATION:

					'%%billing_first_name%%' => $order_data['billing']['first_name'],
					'%%billing_last_name%%' => $order_data['billing']['last_name'],
					'%%billing_company%%' => $order_data['billing']['company'],
					'%%billing_address_1%%' => $order_data['billing']['address_1'],
					'%%billing_address_2%%' => $order_data['billing']['address_2'],
					'%%billing_city%%' => $order_data['billing']['city'],
					'%%billing_state%%' => $order_data['billing']['state'],
					'%%billing_postcode%%' => $order_data['billing']['postcode'],
					'%%billing_country%%' => $order_data['billing']['country'],
					'%%billing_email%%' => $order_data['billing']['email'],
					'%%billing_phone%%' => $order_data['billing']['phone'],

					//SHIPPING INFORMATION:

					'%%shipping_first_name%%' => $order_data['shipping']['first_name'],
					'%%shipping_last_name%%' => $order_data['shipping']['last_name'],
					'%%shipping_company%%' => $order_data['shipping']['company'],
					'%%shipping_address_1%%' => $order_data['shipping']['address_1'],
					'%%shipping_address_2%%' => $order_data['shipping']['address_2'],
					'%%shipping_city%%' => $order_data['shipping']['city'],
					'%%shipping_state%%' => $order_data['shipping']['state'],
					'%%shipping_postcode%%' => $order_data['shipping']['postcode'],
					'%%shipping_country%%' => $order_data['shipping']['country'],
			];
        }


        $new_replace_with=array_merge($replace_with, $user_array);


        $replace_with= apply_filters('elemailer_internal_smart_tags_array', $new_replace_with, $order_obj);

        // we want only list of the shortcodes
       	if($get_keys){
       		
       		// default is needed otherwise woo order related shortcodes will not appear if there is no order present

       		if (function_exists( 'WC' ) ){
				$default_keys= [   
				        '%%order_id%%',
						'%%order_parent_id%%',
						'%%order_status%%',
						'%%order_currency%%',
						'%%order_version%%',
						'%%order_payment_method%%',
						'%%order_payment_method_title%%',
						'%%order_payment_method%%',
						'%%order_payment_method%%',
						'%%get_checkout_payment_url%%',
						'%%order_date_created%%',
						'%%order_date_modified%%',
						'{order_date}',
						'{order_datetime}',
						'%%order_timestamp_created%%',
						'%%order_timestamp_modified%%',
						'%%order_discount_total%%',
						'%%order_discount_tax%%',
						'%%order_shipping_total%%',
						'%%order_shipping_tax%%',
						'%%order_total%%',
						'%%order_total_tax%%',
						'%%order_customer_id%%',
						'%%billing_first_name%%',
						'%%billing_last_name%%',
						'%%billing_company%%',
						'%%billing_address_1%%',
						'%%billing_address_2%%',
						'%%billing_city%%',
						'%%billing_state%%',
						'%%billing_postcode%%',
						'%%billing_country%%',
						'%%billing_email%%',
						'%%billing_phone%%',
						'%%shipping_first_name%%',
						'%%shipping_last_name%%',
						'%%shipping_company%%',
						'%%shipping_address_1%%',
						'%%shipping_address_2%%',
						'%%shipping_city%%',
						'%%shipping_state%%',
						'%%shipping_postcode%%',
						'%%shipping_country%%',
				];
			}

			$default_keys= apply_filters('elemailer_internal_smart_tags_default_list', $default_keys);
			
			$replace_with_key_only= array_keys($replace_with);
			
			$merged_array= array_merge($default_keys,$replace_with_key_only);

			return array_unique($merged_array);  // return list of shortcodes in editor after merge;
		}

		$string= strtr($string,$replace_with);
		
		return $string;
    }

	public function elemailer_content_shortcode_changing_method( $content ) {	
		$post_type = get_post_type();
		if( !in_array($post_type, ['em-form-template', 'em-emails-template']) ) return $content;

		$content=Base::elemailer_internal_smart_tag_parser('', $content, false );
		return $content;
	}


}

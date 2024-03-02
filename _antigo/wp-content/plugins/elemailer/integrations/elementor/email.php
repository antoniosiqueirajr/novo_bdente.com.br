<?php

namespace Elemailer\Integrations\Elementor;

if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

use \Elemailer\Lib\Database\DB;

/**
 * elEmailer wc email template builder class.
 *
 * @author elEmailer
 * @since 1.0.8
 */

class Email{

	use \Elemailer\Traits\Singleton;

	/**
	 * Initialize Email functionality
	 *
	 * @since 1.0.8
	 *
	 * @return void
	 */
	public function init() {
		if ( ! elemailer_has_woocommerce() ) {
			return;
		}

		add_filter( 'wc_get_template', [ $this, 'elemailer_wc_change_content' ], 11, 2 );
		// we may consider removing woocommerce_email_styles part / optimizating it later on as it only plays small role
		add_filter( 'woocommerce_email_styles', [ $this, 'change_styles' ], 11, 2 );
		
		add_filter( 'woocommerce_email_settings_after', [ $this, 'change_email_settings_after' ], 35 );

		// WC general emails subject change
		add_filter( 'woocommerce_email_subject_new_order', [ $this, 'change_new_order_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_cancelled_order', [ $this, 'change_cancelled_order_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_completed_order', [ $this, 'change_customer_completed_order_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_new_account', [ $this, 'change_customer_new_account_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_invoice', [ $this, 'change_customer_invoice_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_invoice_paid', [ $this, 'change_customer_invoice_email_subject_paid' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_reset_password', [ $this, 'change_customer_reset_password_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_note', [ $this, 'change_customer_note_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_on_hold_order', [ $this, 'change_customer_on_hold_order_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_processing_order', [ $this, 'change_customer_processing_order_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_customer_refunded_order', [ $this, 'change_customer_refunded_order_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_failed_order', [ $this, 'change_failed_order_email_subject' ], 35, 2 );

		// WC booking emails subject change
		add_filter( 'woocommerce_email_subject_new_booking', [ $this, 'change_new_booking_email_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_admin_booking_cancelled', [ $this, 'change_admin_booking_cancelled_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_booking_cancelled', [ $this, 'change_booking_cancelled_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_booking_confirmed', [ $this, 'change_booking_confirmed_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_booking_notification', [ $this, 'change_booking_notification_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_booking_pending_confirmation', [ $this, 'change_booking_pending_confirmation_subject' ], 35, 2 );
		add_filter( 'woocommerce_email_subject_booking_reminder', [ $this, 'change_booking_reminder_subject' ], 35, 2 );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_new_booking_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'admin-new-booking' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_admin_booking_cancelled_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'admin-booking-cancelled' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_booking_cancelled_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-booking-cancelled' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_booking_confirmed_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-booking-confirmed' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_booking_notification_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-booking-notification' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_booking_pending_confirmation_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-booking-pending-confirmation' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_booking_reminder_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-booking-reminder' );
	}

	/**
	 * Change email subject for invoice emails
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_invoice_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-invoice' );
	}
	public function change_customer_invoice_email_subject_paid( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-invoice-paid' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_email_settings_after( $email ) {
		$template_type = str_replace( [ 'emails/', '.php' ], [], $email->template_html );
		$emails        = DB::get_all_data_for_wc_email( 'woocommerceemail', $template_type );

		if ( ! empty( $emails ) ) {
			?>
			<div class="template_html">
				<h4><?php esc_html_e( 'HTML template', 'elemailer' ) ?></h4>
				<p><?php esc_html_e( 'You are using Elemailer Email template for this.', 'elemailer' ) ?></p>
			</div>
			<style>#template .template_html{ display: none !important; visibility: hidden; }</style>
			<?php
		}
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_failed_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'admin-failed-order' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_reset_password_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-reset-password' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_refunded_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-refunded-order' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_processing_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-processing-order' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_on_hold_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-on-hold-order' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_note_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-note' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_new_account_email_subject( $subject, $user ) {
		return $this->get_email_subject( $subject, $user, 'customer-new-account' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_customer_completed_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'customer-completed-order' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_cancelled_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'admin-cancelled-order' );
	}

	/**
	 * Change email subject
	 *
	 * @since 1.0.8
	 *
	 * @return html
	 */
	public function change_new_order_email_subject( $subject, $order ) {
		return $this->get_email_subject( $subject, $order, 'admin-new-order' );
	}

	/**
	 * Get email subject
	 *
	 * @since 1.0.8
	 * $order is the wp user object
	 * @return html $template
	 */
	public function get_email_subject( $subject, $order, $template_type ) {

		if ( ! $this->is_order_email( $template_type ) ) {  
		//if this is not an order email rather other woo emails such as customer reset pass
			$template_id = $this->get_template_id( $template_type, $order, false );

			if ( empty( $template_id ) ) {
				return $subject;
			}
			
			set_transient( 'elemailer_wc_email_new_customer_id', $order->ID, 5 );

			$elemailer_subject = get_post_meta( $template_id , 'elemailer__emails_subject', true );

			if ( ! empty( $elemailer_subject ) ) {
				$targets   = [ '{order_date}','{site_url}', '{site_title}', '{order_number}', '{billing_first_name}', '{billing_last_name}' ];
				$replace   = [ gmdate( get_option( 'date_format' ), strtotime( date('Y-m-d') ) ), wp_parse_url( home_url(), PHP_URL_HOST ), wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ), $order->get_order_number(), $order->get_billing_first_name(), $order->get_billing_last_name()];
				$subject   = str_replace( $targets, $replace, $elemailer_subject );
				return $subject;
			}
		} else if ( false !== ( $template_id = $this->get_template_id( $template_type, $order->get_id() ) ) ) {
			if ( empty( $template_id ) ) {
				return $subject;
			}

			$elemailer_subject = get_post_meta( $template_id , 'elemailer__emails_subject', true );

			set_transient( 'elemailer_wc_email_order_id', $order->get_id(), 5 );

			if ( ! $this->is_correct_email( $order->get_id(), $template_id ) ) {
				return $subject;
			}

			if ( elemailer_has_wc_booking() ) {
				$booking = get_wc_booking( $order->get_id() );
	
				if ( $booking ) {
					$order = $booking->get_order();
				}
			}

			if ( ! empty( $elemailer_subject ) ) {
				$targets   = [ '{order_date}','{site_url}', '{site_title}', '{order_number}', '{billing_first_name}', '{billing_last_name}' ];
				$replace   = [ gmdate( get_option( 'date_format' ), strtotime( $order->get_date_created() ) ), wp_parse_url( home_url(), PHP_URL_HOST ), wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ), $order->get_order_number(), $order->get_billing_first_name(), $order->get_billing_last_name() ];
				$subject   = str_replace( $targets, $replace, $elemailer_subject );
				return $subject;
			}
		}

		return $subject;
	}

	/**
	 * Change email template content
	 *
	 * @since 1.0.8
	 *
	 * @param html  $template
	 * @param array $template_name
	 *
	 * @return html $template
	 */
	public function elemailer_wc_change_content( $template, $template_name ) {
		$template_type = str_replace( [ 'emails/', '.php' ], [], $template_name );
		$order_id      = get_transient( 'elemailer_wc_email_order_id' );
		$customer = new \WC_Customer( get_transient( 'elemailer_wc_email_new_customer_id' ));

		// this is a customer account related email - new account, reset pass - pass customer obj
		if ( ! $this->is_order_email( $template_type ) ) {
			$template_id = $this->get_template_id( $template_type, $customer, false );

			if ( empty( $template_id ) ) {
				return $template;
			}

			$_REQUEST['template_id'] = $template_id;
			return ELE_MAILER_PLUGIN_PUBLIC_DIR . '/views/wc-email-template.php';
		}else if ( false !== ( $template_id = $this->get_template_id( $template_type, $order_id, true ) ) ) { // @4.0.2 patch in the get_template_id function to return fake invoice status email  
			if ( empty( $template_id ) ) {
				return $template;
			}

			$order = wc_get_order( $order_id );

			if ( elemailer_has_wc_booking() ) {
				$booking = get_wc_booking( $order_id );
	
				if ( $booking ) {
					$order = $booking->get_order();
					// make sure delete transient
					delete_transient( 'elemailer_wc_email_booking_order_id' );
					set_transient( 'elemailer_wc_email_booking_order_id', $order->get_id(), 5 );
				}
			}

			$_REQUEST['order']       = $order;
			$_REQUEST['template_id'] = $template_id;
			$_REQUEST['template_type'] = $template_type;
			return ELE_MAILER_PLUGIN_PUBLIC_DIR . '/views/wc-email-template.php';
		}

		return $template;
	}

	/**
	 * Check email is order or not
	 *
	 * @since 1.0.8
	 *
	 * @param string $template
	 *
	 * @return boolean
	 */
	public function is_order_email( $template ) {
		
		// * @since 3.9 - Not sure why the array system check didn't work, but it caused product condition to not work

		// $non_order_emails = [
		// 	'customer-new-account',
		// 	'customer-reset-password',
		// ];
		// in_array( $template, $non_order_emails, true ) ? false : true;

		if ($template=='customer-new-account' || $template=='customer-reset-password' ){
			return false;
		}  else {
			return true;
		}
	}

	/**
	 * Check email template is correct
	 *
	 * @since 1.0.8
	 *
	 * @param int $order_id
	 * @param int $template_id
	 *
	 * @return boolean
	 */
	public function is_correct_email( $order_id, $template_id ) {
		if ( empty( $order_id ) ) {
			return false;
		}

		$wc_product  = get_post_meta( $template_id, 'elemailer_wc_product', true );
        $wc_category = get_post_meta( $template_id, 'elemailer_wc_category', true );
        $where_apply = get_post_meta( $template_id, 'elemailer_wc_email_where_apply', true );

		if ( 'global' === $where_apply ) {
			return true;
		}

		if ( empty( $wc_product ) && empty( $wc_category ) && empty( $where_apply ) ) {
			return false;
		}

		$wc_product   = isset( $wc_product ) && ! empty( $wc_product ) ? array_map( 'intval', $wc_product ) : [];
		$wc_category  = isset( $wc_category ) && ! empty( $wc_category ) ? array_map( 'intval', $wc_category ) : [];

		if (
			in_array( 1, $wc_category, true ) ||
			in_array( 1, $wc_product, true )
		) {
			return true;
		}

		$order = wc_get_order( $order_id );

		if ( elemailer_has_wc_booking() ) {
			$booking = get_wc_booking( $order_id );

			if ( $booking ) {
				$order = $booking->get_order();
			}
		}

		if ( ! is_a( $order, 'WC_Order' ) ) return false;
		
		$items        = $order->get_items();
		$product_ids  = array();
		$category_ids = array();

		foreach ( $items as $item ) {
			$product_ids[] = $item->get_product_id();
			$post_type     = get_post_type( $item->get_product_id() );

			if ( 'product_variation' === $post_type ) {
                $product_ids[] = wp_get_post_parent_id( $item->get_product_id() );
            }

			$terms = get_the_terms( $item->get_product_id(), 'product_cat' );

			foreach ( $terms as $term ) {
				$category_ids[] = $term->term_id;
			}
		}

		$wc_category_result = array_intersect( $wc_category, $category_ids );

		if ( ! empty( $wc_category_result ) && 'category' === $where_apply ) {
			return true;
		}

		$wc_product_result = array_intersect( $wc_product, $product_ids );

		if ( ! empty( $wc_product_result ) && 'product' === $where_apply ) {
			return true;
		}

		return false;
	}

	/**
	 * Change email template style
	 *
	 * @since 1.0.8
	 *
	 * @param string $styles
	 * @param Object $object
	 *
	 * @return string $styles
	 */
	public function change_styles( $styles, $object ) {
		$template_type = str_replace( [ 'emails/', '.php' ], [], $object->template_html );
		$order_id      = get_transient( 'elemailer_wc_email_order_id' );
		// delete transient
		delete_transient( 'elemailer_wc_email_order_id' );

		if ( ! $this->is_order_email( $template_type ) ) {
			$template_id = $this->get_template_id( $template_type, $order_id, false );

			if ( empty( $template_id ) ) {
				return $styles;
			}

			ob_start();
			echo elemailer_get_template_css( $template_id );
			return ob_get_clean();
		} else if ( false !== ( $template_id = $this->get_template_id( $template_type, $order_id ) ) ) {	
			if ( empty( $template_id ) ) {
				return $styles;
			}

			ob_start();
			echo elemailer_get_template_css( $template_id );
			return ob_get_clean();
		}

		return $styles;
	}

	/**
	 * Get template id
	 *
	 * @since 1.0.8
	 *
	 * @return int $template_id
	 */
	public function get_template_id( $template_type, $order_id, $is_order_email = true ) {
		//fake change the customer-invoice email template to customer-invoice-paid if status is not pending @since 4.0.2
		if($template_type=='customer-invoice'){
			$order = wc_get_order( $order_id );
			if(!empty($order) && !$order->has_status( 'pending' )){
				$template_type='customer-invoice-paid';
			}
		}

		$emails       = DB::get_all_data_for_wc_email( 'woocommerceemail', $template_type );
		$emails       = ( is_array( $emails ) ? $emails : [] );
		$template_ids = [];

		foreach ( $emails as $email ) {
			if ( $is_order_email && $this->is_correct_email( $order_id, $email->ID ) ) {
				$template_ids[] = $email->ID;
			}else if( !$is_order_email && $this->is_correct_email( $order_id, $email->ID ) ){
				$template_ids[] = $email->ID;
			} 
		}

		return ! empty( $template_ids ) ? max( $template_ids ) : 0;
	}
}

<?php

namespace Elemailer\Integrations\Shortcode\Actions;

defined('ABSPATH') || exit;

/**
 * Shortcode hooks related class
 * 
 * 
 * Sample of shortcode and meaning ------
 * [ele_override_start][elemailer:id="244" myfname:emap:{field_id="0"} /esplit/ ele_email:emap:{admin_email} ][ele_override_end]
 * 
 * [ele_override_start] [ele_override_end] -> Will determine if we should override the template or not
 * 
 * [elemailer:id="244"] -> is the general shortcode
 * 
 * :emap: -> Is used for making mapping with any form's given shortcode/smart tags. ele_fname:emap:{field_id="0"} 
 * 
 * /esplit/ -> Has to be used if there are more than one field for mapping ele_fname, ele_email and so on. 
 * Sample end -------
 * 
 * Alloewd filters 
 * 
 * add_filter( 'elemailer_wp_mail_override_content_replace', [$this, 'ourcontent_replacearray'], 10, 1); 
 *  return array('<br />', <p>); // what to replace
 * 
 * add_filter( 'elemailer_wp_mail_override_content_replace_with', [$this, 'ourcontent_replacewitharray'], 10, 1);  
 *  return array('a', b); // what to replace with
 * 
 *  do_action( 'elemailer_before_str_replace_and_filter', $mod_content, $replace, $replace_with ); // for developers
 * 
 * ------------
 * @author elEmailer 
 * @since 2.6
 */
class Elewpmail {
    use \Elemailer\Traits\Singleton;

    /**
     * Inilial class for shortcode hooks function
     * 
     * @since 2.6
     * 
     * @return void
     */
    public function init() {
        add_filter( 'wp_mail', [ $this, 'change_mail_content' ], 10, 1);
    }

    /**
     * Change mail content
     *
     * @since 2.6
     * 
     * @return string
     */
    public function change_mail_content( $mail ) {
        $mail['message'] =  $this->process_elemailer_shortcode( $mail['message'] );
        return $mail;
    }

    /**
     * Set content type
     *
     * @since 2.6
     * 
     * @return string
     */
    public function set_content_type() {
        return 'text/html';
    }

    /**
     * Change mail charset
     *
     * @since 2.6
     * 
     * @return string
     */
    public function change_mail_charset() {
        return 'UTF-8';
    }    

    /**
     * Only return elemailer template and remove everything else unless we enable the last line commented
     * 
     * @since 2.6
     * 
     * @param string[shortcode] $shortcode
     * 
     * @return string[html] $html
     */
    public function process_elemailer_shortcode( $content ) {   
        $status = preg_match_all('(\[ele_override_start\](.*?)\[ele_override_end\])s', $content, $data, PREG_SET_ORDER);
        
        // Return early if it's not an override tag
        if ( ! $status ) return $content;

        $mod_content = isset($data[0][0]) ? $data[0][0] : false; // Keeping parsed shortcode part only in mod_content
        $status      = preg_match_all('(\[elemailer:id="[0-9]+")', $mod_content, $data, PREG_SET_ORDER); // We change the regex from original
        
        // Return early if it doesn't have elemailer shortcode inside 
        if ( ! $status ) return $content;

        add_filter( 'wp_mail_content_type', [$this, 'set_content_type'], 10, 1);
        add_filter( 'wp_mail_charset', [$this, 'change_mail_charset'], 10, 1);

        $id = isset($data[0][0]) ? $data[0][0] : false;
        $id = (int) filter_var($id , FILTER_SANITIZE_NUMBER_INT); // new got our template id

        // Keeping only :emap: parts of our shortcode
        // We construct an asso. array with key and value of each filed for original email

        $mod_content     = str_replace(['elemailer:id="'.$id.'"','[ele_override_start]','[ele_override_end]'],'',$mod_content);
       
        $replace         = array('<br />'); // Str replace as needed
        $replace_with    = array(',');

        do_action( 'elemailer_before_str_replace_and_filter', $mod_content, $replace, $replace_with ); // for developers
        
        $content       = trim(str_replace(apply_filters('elemailer_wp_mail_override_content_replace', $replace), apply_filters('elemailer_wp_mail_override_content_replace_with', $replace_with), $mod_content));
        
        $content       = substr($content,1,-1);
        $maparray      = explode('/esplit/', $content);
        $mapped_fields = array();

        foreach ( $maparray as $mapped ) {
            $map = explode(':emap:', $mapped);
            
            if ( ! empty( $map[1] ) ) {
                $mapped_fields[ trim($map[0]) ] = trim( $map[1] );
            }
        }

        $elemailer_content = \Elemailer\Helpers\Util::get_template_content($id);
        $elemailer_content = \Elemailer\Helpers\Util::get_email_html_template($id, $elemailer_content);

        // Replace the field id of elemailer tempalte with kept array of data from original email
        if ( ! empty( $mapped_fields ) ) {
            $content = strtr($elemailer_content,$mapped_fields);
        } else {
            $content = $elemailer_content; // If no field id was defined we still want to return our elemailer template
        }

        return $content;

        remove_filter( 'wp_mail_content_type', [$this, 'set_content_type']);
        remove_filter( 'wp_mail_charset', [$this, 'change_mail_charset']);
    }
}

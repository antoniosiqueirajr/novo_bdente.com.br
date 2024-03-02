<?php

namespace Elemailer\Integrations\Elementor\Actions;

defined('ABSPATH') || exit;

use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Core\Base\Document as BaseDoc;


/**
 * all hook related class for activating some extra functionality based on elementor
 *
 * @author elEmailer
 * @since 1.0.0
 */
class Hooks
{
    use \Elemailer\Traits\Singleton;

    /**
     * initial function of this class
     *
     * @since 1.0.0
     */
    public function trigger_elementor_free_actions()
    {
        // add template select control in elementor form widget
        add_action('elementor/element/form/section_email/before_section_end', [$this, 'email_template_selector'], 10, 2);

        // add template select control in elementor form widget
        add_action('elementor/element/form/section_email_2/before_section_end', [$this, 'email2_template_selector'], 10, 2);

        // add custom background control in section control
        add_action('elementor/element/section/section_background/before_section_end', [$this, 'section_background'], 10, 2);
        // add custom body settings control in document setting
        add_action('elementor/documents/register_controls', [$this, 'register_document_controls']);
        // change the title of the setting panel for our email type
        add_filter('elementor/document/config', [$this, 'register_document_config'],10,2);

        // action for wc email dynamic tag
        add_action('elementor/controls/register', [$this, 'register_random_number_dynamic_tag']);

        // remove container experiement inside elemailer since @2.6
        // with the same function action we also register custom font + remove google font - reason is this runs before the editor loads so the add_filters for the fonts work
        add_action( 'elementor/experiments/default-features-registered', [$this, 'remove_container_experiment'],1);
        add_filter( 'elementor/admin/localize_settings', [$this, 'remove_all_experiment_requirement'],1);
    

        add_action( 'elementor/css-file/post/parse', [$this, 'add_custom_css'],1);
        
        // add elemailer class to wrapper of email template
        add_action( 'elementor/document/wrapper_attributes', [$this, 'elemailer_add_class_to_main_page'], 10,2);

        //add custom css class option to all widgets, sections etc
        add_action( 'elementor/element/before_section_end', [$this,'add_custom_css_class_control'], 10, 3 );
        
        //modify content only on the frontend not in editor for email rendering
        add_action( 'elementor/frontend/before_get_builder_content', [$this, 'elemailer_email_render_modify_call'],10,1);

    }

    /**
     * function to add elemailer-content class to elemailer email template
     * we use this to add css that we add to body here as well as some email clinets strips css from body class
     * @return attributes array for rendering in elementor page
     * @param $attributes[], $obj= $this
     * @since 4.0.13
     */
        
    public function elemailer_add_class_to_main_page( $attributes, $obj ) {

        // return early if it's not elemailer post type
        if(!in_array( get_post_type($obj->get_main_id()), ['em-form-template', 'em-emails-template'] ) ){
            return $attributes;
        } 

        $attributes['class'] = 'elemailer-content '.$attributes['class'];
        
        return $attributes;

    }

    /**
     * We use this elementor/frontend/before_get_builder_content filter to target only our post type as otherwise the document ID is gone
     * @since 4.0.13
     */

    public function elemailer_email_render_modify_call($document){
            // return early if it's not elemailer post type
        if(!in_array( get_post_type($document->get_main_id()), ['em-form-template', 'em-emails-template'] ) ){
            return;
        }

        add_action( 'elementor/frontend/before_render', [$this, 'modify_before_render_frontend_only'],10,1);
        add_action( 'elementor/frontend/after_render', [$this, 'modify_after_render_frontend_only'],10,1);

    }

    // used to add new font group for elemailer only and remove old font groups
    public function elemailer_font_group($font_groups){
        $new_font_group = array(
                            'elemailer-web-safe-Sans-serif' => __( 'Sans-serif (Safe Fonts)' ),
                            'elemailer-web-safe-Serif' => __( 'Serif (Safe Fonts)' ),
                            'elemailer-web-safe-Monospaced' => __( 'Monospaced (Safe Fonts)' ),
                            'elemailer-web-safe-Fantasy' => __( 'Fantasy (Safe Fonts)' ),
                            'elemailer-web-safe-Script' => __( 'Script (Safe Fonts)' ),

                                );
        //return array_merge( $new_font_group, $font_groups );  //use this to return all font & groups
        return $new_font_group;
    }    

    // Web safe fonts as per https://www.cssfontstack.com/
    
    public function elemailer_fonts($additional_fonts){
        //Font name/font group
        $additional_fonts['Arial, "Helvetica Neue", Helvetica, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Arial Black", "Arial Bold", Gadget, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Arial Narrow", Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, AppleGothic, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Candara, Calibri, Segoe, "Segoe UI", Optima, Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Century Gothic", CenturyGothic, AppleGothic, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Futura, "Trebuchet MS", Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Geneva, Tahoma, Verdana, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Gill Sans", "Gill Sans MT", Calibri, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Helvetica Neue", Helvetica, Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Impact, Haettenschweiler, "Franklin Gothic Bold", Charcoal, "Helvetica Inserat", "Bitstream Vera Sans Bold", "Arial Black"'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Verdana, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Optima, Segoe, "Segoe UI", Candara, Calibri, Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Tahoma, Verdana, Segoe, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['Verdana, Geneva, sans-serif'] = 'elemailer-web-safe-Sans-serif';
        $additional_fonts['"Big Caslon", "Book Antiqua", "Palatino Linotype", Georgia, serif'] = 'elemailer-web-safe-Serif';
        
        $additional_fonts['"Bodoni MT", Didot, "Didot LT STD", "Hoefler Text", Garamond, "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['"Book Antiqua", Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, seri'] = 'elemailer-web-safe-Serif';
        $additional_fonts['"Calisto MT", "Bookman Old Style", Bookman, "Goudy Old Style", Garamond, "Hoefler Text", "Bitstream Charter", Georgia, serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Cambria, Georgia, serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Didot, "Didot LT STD", "Hoefler Text", Garamond, "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Georgia, Times, "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['"Goudy Old Style", Garamond, "Big Caslon", "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['"Hoefler Text", "Baskerville Old Face", Garamond, "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['"Lucida Bright", Georgia, serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Perpetua, Baskerville, "Big Caslon", "Palatino Linotype", Palatino, "URW Palladio L", "Nimbus Roman No9 L", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Rockwell, "Courier Bold", Courier, Georgia, Times, "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['"Rockwell Extra Bold", "Rockwell Bold", monospace'] = 'elemailer-web-safe-Serif';
        $additional_fonts['Baskerville, "Baskerville Old Face", "Hoefler Text", Garamond, "Times New Roman", serif'] = 'elemailer-web-safe-Serif';
        $additional_fonts['TimesNewRoman, "Times New Roman", Times, Baskerville, Georgia, serif'] = 'elemailer-web-safe-Serif';
        
        $additional_fonts['Consolas, monaco, monospace'] = 'elemailer-web-safe-Monospaced';
        $additional_fonts['"Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace'] = 'elemailer-web-safe-Monospaced';
        $additional_fonts['"Lucida Console", "Lucida Sans Typewriter", monaco, "Bitstream Vera Sans Mono", monospace'] = 'elemailer-web-safe-Monospaced';
        $additional_fonts['"Lucida Sans Typewriter", "Lucida Console", monaco, "Bitstream Vera Sans Mono", monospace'] = 'elemailer-web-safe-Monospaced';
        $additional_fonts['monaco, Consolas, "Lucida Console", monospace'] = 'elemailer-web-safe-Monospaced';
        $additional_fonts['"Andale Mono", AndaleMono, monospace'] = 'elemailer-web-safe-Monospaced';

        $additional_fonts['Copperplate, "Copperplate Gothic Light", fantasy'] = 'elemailer-web-safe-Fantasy';
        $additional_fonts['Papyrus, fantasy'] = 'elemailer-web-safe-Fantasy';

        $additional_fonts['"Brush Script MT", cursive'] = 'elemailer-web-safe-Script';

        return $additional_fonts;
    }



    /**
     * functions to modify the render content on the frontend/email only for our post type
     * with this we add support for outlook css for example
     * @param $element = $this
     * @since 4.0.13
     */

    public function modify_before_render_frontend_only( $element ) {
               
        $settings = $element->get_settings();
        
        if('section'==  $element->get_name()) {

            $outlook_bg_height = 10;
            $outlook_bg_content_start ='';
            $section_bg_color='';
            $custom_css_classes='';
            
            if(!empty($settings['section_background_type']) && $settings['section_background_type']=='image' ){

                if(!empty($settings['outlook_section_height']) ){

                    $outlook_bg_height=$settings['outlook_section_height']*.75;

                }

                $outlook_bg_content_start='
                          <v:image xmlns:v="urn:schemas-microsoft-com:vml" fill="true" cover="true" stroke="false" style="border: 0;display: inline-block; width:450pt; height:'.$outlook_bg_height.'pt;" src="'.$settings['section_background_image']['url'].'" />
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" filled="true" aspect="atleast" stroke="false" style="border: 0;display: inline-block;position: absolute; width:450pt; height:'.$outlook_bg_height.'pt;">
                            <v:fill opacity="0%" />
                            <v:textbox tyle="mso-fit-shape-to-text:true" inset="0,0,0,0">
                       ';

            }else if(!empty($settings['section_background_color']) ){ 
            //this is not mendatory but we are doing it for future usecase, because right now if we were to enable custom css with selector system it will not work as get_template_styles() removes some classes of elementor. 
            
                $section_bg_color = 'style="background-color:'.$settings['section_background_color'].';';
            }
            
            if(!empty($settings['e_custom_class'])){
                $custom_css_classes= $settings['e_custom_class'];
            }
                echo' 
                <!--[if mso]>
                <elemailer_table '.$section_bg_color.' border="0" cellpadding="0" width="100%" cellspacing="0" class="stab-elementor-element-'.$element->get_id().' '.$custom_css_classes.'">'.$outlook_bg_content_start.'
                    <tr>
                <![endif]-->';
        

        }

        if('column'==  $element->get_name()) {

            if(!empty($settings['_inline_size'])){
                $col_width=$settings['_inline_size'];
            }else{
                $col_width=$settings['_column_size'];
            }

            echo'<!--[if mso]>
            <td width="'.$col_width.'%" >
            <![endif]-->';
        }
        

    }

    public function modify_after_render_frontend_only( $element ) {

        $settings = $element->get_settings();

        if('column'==  $element->get_name()) {

            echo'<!--[if mso]>
             </td>
            <![endif]-->';
        }

        if('section'==  $element->get_name()) {
        
        $outlook_bg_content_end ='';

            if(!empty($settings['section_background_type']) && $settings['section_background_type']=='image' ){

                $outlook_bg_content_end ='
                            </v:textbox>
                                </v:fill>
                                </v:rect>
                            </v:image>';

            }

            echo'<!--[if mso]>
            </tr>'.$outlook_bg_content_end.'
            </elemailer_table>
            <![endif]-->';
        }
        
    }

    /**
     * function to add custom css class control attribute to all widgets
     * @param $element = $this
     * @since 4.0.13
     */

    public function add_custom_css_class_control( $element, $section_id, $args ) {
        
        if(!in_array( get_post_type(get_queried_object_id()), ['em-form-template', 'em-emails-template'] )  && \Elementor\Plugin::$instance->editor->is_edit_mode() ){
            return;
        }
        else if( 'advanced_section' === $section_id  ) {
               $element->add_control(
                    'e_custom_class' ,
                    [
                        'label' => esc_html__( 'CSS Classes', 'elemailer' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => esc_html__( 'myclass myclass2', 'elemailer' ),
                        'prefix_class' => '', // this is needed to add these changes directly in the editor live
                        //'classes' => 'elementor-control-direction-ltr',
                        'ai' => [
                            'active' => false,
                        ],

                    ]
                );

               $element->add_control(
                        'margin_padding_warning',
                        [               
                            'separator' => 'before',
                            'type' => \Elementor\Controls_Manager::RAW_HTML,
                            'raw' => __( '<small style="color: white;font-size: 10px;">Important: Margin, padding and many other CSS are not supported by Windows outlook also known as Mail Desktop app.</small>', 'elemailer' ),
                            'content_classes' => 'elementor-control-field-description',
                        ]
                );


        }

    }



    /**
     * function for activate elementor pro functionality
     *
     * @return void
     * @since 1.0.0
     */
    public function trigger_elementor_pro_actions()
    {
        // elementor form submission catch hook
         //@since v1.0.3 after it introduced Form_Actions_Registrar class to add control

        if(class_exists('\ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar')){

            add_action('elementor_pro/forms/actions/register', [$this, 'trigger_elementor_form_submission_new']);
            add_action( 'elementor_pro/forms/actions/register', [ $this, 'add_subscriber_action_on_form_submission_new']);

        }else{ // Fallback for older releases before 3.5 pro ie: 3.4.2 we will remove it in future

            add_action('elementor_pro/forms/form_submitted', [$this, 'trigger_elementor_form_submission']);
            // elementor form submission custom action add
            add_action( 'elementor_pro/init', [ $this, 'add_subscriber_action_on_form_submission']);

        }

    }

    /**
     * elementor missing notice function
     *
     * @return void
     * @since 1.0.0
     */
    public function register_random_number_dynamic_tag( $controls_manager )
    {
        // Here its safe to include our action class file
        include_once( 'email-dynamic-tag.php' );

        $controls_manager->register( new \Elemailer_WC_Email_Dynamic_Tag );
    }

    /**
     * catch elementor pro form submission function - 3.5 pro new version support
     *
     * @param object $module
     * @since 1.0.3
     * to fix depreceation
     */
    public function trigger_elementor_form_submission_new($module)
    {
        // override email class of elementor pro
        $module->register(new Void_Email());

        // override email2 class of elementor pro
        $module->register(new Void_Email2());
    }

    /**
     * catch elementor pro form submission function
     *
     * @param object $module
     * @since 1.0.0
     */
    public function trigger_elementor_form_submission($module)
    {
        // override email class of elementor pro
        $module->add_form_action('email', new Void_Email());

        // override email2 class of elementor pro
        $module->add_form_action('email2', new Void_Email2());
    }

    /**
     * add subscriber during elementor pro custom submission hook function 3.6 pro new version support
     *
     * @return void
     * @since 2.0.1
     * to fix depreceation
     */
    public function add_subscriber_action_on_form_submission_new($actions_registrar){
        // Here its safe to include our action class file
        include_once( 'subscriber-handler.php' );
        
        $actions_registrar->register( new Subscriber_Handler() );

    }

    /**
     * add subscriber during elementor pro custom submission hook function
     *
     * @return void
     * @since 1.0.0
     */
    public function add_subscriber_action_on_form_submission(){
        // Here its safe to include our action class file
        include_once( 'subscriber-handler.php' );
        
        // Instantiate the action class
        $subscriber_handler = new Subscriber_Handler();
    
        // Register the action with form widget
        \ElementorPro\Plugin::instance()->modules_manager->get_modules( 'forms' )->add_form_action( $subscriber_handler->get_name(), $subscriber_handler );
    }

    /**
     * option for selecting void email template function in form widget
     *
     * @param object $element
     * @param array $args
     * @since 1.0.0
     */
    public function email_template_selector($element, $args)
    {
        // add a control
        $element->add_control(
            'show_elemailer_email_template_selector',
            [
                'label' => esc_html__('Use Elemailer Template', 'elemailer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elemailer'),
                'label_off' => esc_html__('No', 'elemailer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'select_elemailer_email_template',
            [
                'label' => esc_html__('Choose Elemailer Template', 'elemailer'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => \Elemailer\App\Form_Template\Action::instance()->get_all_template(),
                'condition' => [
                    'show_elemailer_email_template_selector' => 'yes',
                ],
            ]
        );
    }

    /**
     * option for selecting void email template function in form widget
     *
     * @param object $element
     * @param array $args
     * @since 1.0.0
     */
    public function email2_template_selector($element, $args)
    {
        // add a control
        $element->add_control(
            'show_elemailer_email_template_selector_2',
            [
                'label' => esc_html__('Use Elemailer template', 'elemailer'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'elemailer'),
                'label_off' => esc_html__('No', 'elemailer'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'select_elemailer_email_template_2',
            [
                'label' => esc_html__('Select Elemailer template', 'elemailer'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => \Elemailer\App\Form_Template\Action::instance()->get_all_template(),
                'condition' => [
                    'show_elemailer_email_template_selector_2' => 'yes',
                ],
            ]
        );
    }

    /* @since 4.0.1 print custom css in the template */ 
    public function add_custom_css($post_css){

        $document = \Elementor\Plugin::$instance->documents->get( $post_css->get_post_id() );
        $custom_css = $document->get_settings( 'elemailer_root_custom_css' );

        if ( empty( $custom_css ) ) {
            return;
        }

        $custom_css = str_replace( 'selector', $document->get_css_wrapper_selector(), $custom_css );
        // Remove whitespace
        $output = preg_replace('/\s*([{}|:;,])\s+/', '$1', $custom_css);
        // Remove trailing whitespace at the start
        $custom_css = preg_replace('/\s\s+(.*)/', '$1', $output);
        // Remove unnecesairy ;'s commenting it for safety
        //$custom_css = str_replace(';}', '}', $custom_css);

        $post_css->get_stylesheet()->add_raw_css( $custom_css );

    }

    /**
     * Remove the container experiement. TO DO: in future further modification will be needed for sure.
     * @since 2.6
     */
    public function remove_container_experiment( $document ) {
        if(isset( $_GET['post']) && in_array( get_post_type($_GET['post']), ['em-form-template', 'em-emails-template'] ) ){
        // remove container ex. 
        $document->remove_feature( 'container');   

         // Add new font group (Custom) to the top of the list
        add_filter( 'elementor/fonts/groups', [$this, 'elemailer_font_group'],10,1);
        // Add our custom font list
        add_filter( 'elementor/fonts/additional_fonts', [$this, 'elemailer_fonts'],10,1);

        add_filter( 'pre_option_elementor_experiment-editor_v2', function() {
            return 'inactive';
        } );

        }
    }

    public function remove_all_experiment_requirement( $settings ) {
          if(isset( $_GET['post']) && in_array( get_post_type($_GET['post']), ['em-form-template', 'em-emails-template'] ) ){
           
            $settings['experiments']='';
            
            return $settings; //return empty expreiemt list for our post types
         
          }
          return $settings; // return original value
    }

    /**
     * custom control for elemailer email body settings
     * @since 2.6
     */

    public function register_document_controls($document)
    {
    
        if ( ! $document instanceof \Elementor\Core\DocumentTypes\PageBase || ! $document::get_property( 'has_elements' ) || ! in_array( get_post_type($document->get_main_id()), ['em-form-template', 'em-emails-template'] ) ) {
            return;
        }
     

        $document->start_controls_section(
            'elemailer_settings',
            [
                'label' => esc_html__( 'Elemailer Email Settings', 'elemailer' ),
                'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                'classes'=> 'elemailer-main-settings',
            ]
        );

        $document->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [   
                    'label_block'=> true,
                    'show_label'=> true,
                    'name' => 'elemailer_body_background',
                    'types' => [ 'classic' ],
                    'selector' => '{{WRAPPER}},.outlook-special',
                    'fields_options' => [
                        'background' => [
                            'default' => 'classic',
                            'label' => esc_html__( 'Email Body Background', 'elemailer' ),
                            'description' => 'Set a background for the body of your email. Keep in mind some of the settings might not work in some email platforms due to not having the support for modern CSS.',             
                        ],
                        'color' => [
                                'default' => '#FFFFFF',
                                'dynamic' => [
                                    'active' => false,
                                ],
                                'global' => [
                                    'active' => false,
                                ],
                        ],
                        'image' =>[
                            'responsive' => false,
                        ],
                        'position' =>[
                            'responsive' => false,
                        ],
                        'attachment' =>[
                            'responsive' => false,
                        ],
                        'repeat' =>[
                            'responsive' => false,
                        ],
                        'size' =>[
                            'responsive' => false,
                        ],
                    ],
        
                    
                ],

            );

        //@since 3.6
        $document->add_control(
            'elemailer_body_default_section_padding',
            [
                'label'         => __( 'Section default padding', 'elemailer' ),
                'type'          => Controls_Manager::DIMENSIONS,
                'description'   => __('The default value is set to 10px if left empty. Set all to 0 if you do not want section to section padding','elemailer'),
                'size_units'    => [ 'px', '%' ],
                'default'       => [
                        'top' => '10',
                        'right' => '10',
                        'bottom' => '10',
                        'left' => '10',
                        'unit' => 'px',
                        'isLinked' => true,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .elementor-row .elementor-column .elementor-element-populated .elementor-widget-wrap,{{WRAPPER}} .elementor-column .elementor-element-populated.elementor-widget-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $document->add_control(
            'elemailer_root_custom_css',
            [
                'label' => esc_html__( 'Email Custom CSS', 'elemailer' ),
                'description'=> esc_html__( 'Warning: It might seem easy enough to add any css and view that on your email template but please bear in mind the css you add might not work in some Email Clients due to not being supported. Infact the CSS support is very limited in most Clients. So use custom css at your own risk', 'elemailer' ),
                'type' => \Elementor\Controls_Manager::CODE,
                'separator' => 'before',
                'label_block' => true,
                'render_type' => 'ui',
                'language' => 'css',
                'classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                'rows' => 20,
                'ai' => [
                    'language' => 'css',
                ],
            ]
        );


         $document->add_control(
            'elemailer_export_html_button',
            [
                'type' => \Elementor\Controls_Manager::BUTTON,
                'separator' => 'before',
                'button_type' => 'default',
                'text' => esc_html__( 'Export', 'elemailer' ),
                'event' => 'elemailer:email:export',
                'label' => 'Export as HTML file',
            ]
        );

        // since @3.5 email teser fields under setting gear icon for elemailer 
        
        $document->add_control(
                'elemailer_preview_email_beginning',
                [               
                    'separator' => 'before',
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw' => __( '<b style="color:orange; font-size:13px;">Send Test Email</b><br><br>You can send test email to your real email using this and see how the design looks in real emails without sending it to your visitors first. Please keep in mind any dynamic content will not be rendered in email such as shortcodes, WooCommerce order data', 'elemailer' ),
                    'content_classes' => 'elementor-control-field-description',
                ]
        );

        $document->add_control(
            'elemailer_preview_email',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Enter valid email', 'elemailer' ),
                'ai' => [
                    'active' => false,
                ],
            ]
        );

        $document->add_control(
            'elemailer_preview_email_send',
            [
                'type' => \Elementor\Controls_Manager::BUTTON,
                'button_type' => 'default',
                'text' => esc_html__( 'Send', 'elemailer' ),
                'event' => 'elemailer:email:preview',
            ]
        );

        $document->add_control(
                'elemailer_templateid',
                [
                    'label' => esc_html__( 'Current template ID', 'elemailer' ),
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => get_the_ID(),
                ]
        );

        $document->add_control(
                'elemailer_testemail_nonce',
                [
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => wp_create_nonce( 'elemailer_test_email_nonce' ),
                ]
        );

        $document->add_control(
                'elemailer_testemail_siteurl',
                [
                    'type' => \Elementor\Controls_Manager::HIDDEN,
                    'default' => admin_url('admin-ajax.php'),
                ]
        );




        $document->end_controls_section();
        
    }

    // passed array, id of the page
    public function register_document_config($obj, $id){

        if(!in_array( get_post_type($id), ['em-form-template', 'em-emails-template'] ) ){
            return;
        } 

        $obj['settings']['panelPage']['title'] = __('Email Settings','elemailer');
        $obj['urls']['exit_to_dashboard'] =  empty(wp_get_referer()) ? admin_url() : wp_get_referer();
        
        return $obj;
    }

    /**
     * custom control add in section of elementor for adding background
     *
     * @param object $element
     * @param array $args
     * @return void
     * @since 1.0.0
     */
    public function section_background($element, $args)
    {
        // return if this is not post type of elemailer
        $post_type = get_post_type();

        if (
            ! in_array( $post_type, ['em-form-template', 'em-emails-template'] ) &&
            \Elementor\Plugin::$instance->editor->is_edit_mode()
        ) {
            return;
        }

        $element->add_control(
            'section_background_type',
            [
                'label' => __('Background Type', 'elemailer'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'color',
                'classes' => 'elemailer-section-control',
                'options' => [
                    'color'  => __('Color', 'elemailer'),
                    'image' => __('Image', 'elemailer'),
                ],
            ]
        );

        $element->add_control(
            'section_background_color',
            [
                'label' => __('Background Color', 'elemailer'),
                'type' => Controls_Manager::COLOR,
                 'classes' => 'elemailer-section-control',
                // 'separator' => 'before',
                'condition' => [
                    'section_background_type' => 'color',
                ],
                'selectors' => [
                    '{{WRAPPER}} > .elementor-container' => 'background: {{VALUE}};',
                    '.stab-elementor-element-{{ID}}' => 'background-color:{{VALUE}}',
                ],
                'dynamic' => [
                    'active' => false,
                ],
                'global' => [
                    'active' => false,
                ],
            ]
        );

        $element->add_control(
            'section_background_image',
            [
                'label' => __('Choose Image', 'elemailer'),
                 'classes' => 'elemailer-section-control',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'section_background_type' => 'image',
                ],
                'selectors' => [
                    '{{WRAPPER}} > .elementor-container' => 'background: url(\'{{URL}}\') no-repeat center;',
                    '.stab-elementor-element-{{ID}}' => 'background: url(\'{{URL}}\') no-repeat center;',
                ],
            ]
        );

        $element->add_control(
            'outlook_section_height',
            [
                'label' => esc_html__( 'Outlook background height', 'elemailer' ),
                'classes' => 'elemailer-section-control',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'description' => __('This will be used for your outlook windows desktop app email image rendering as outlook needs a fixed height for background image to work in px','elemailer'),
                'min' => 5,
                'max' => 10000000,
                'step' => 5,
                'default' => 100,
                'condition' => [
                    'section_background_type' => 'image',
                ],
                'render_type' => 'none',
            ]
        );



    
        /**
        * function to add custom css class control attribute to sections
        * @param $element = $this
        * @since 4.0.13
        */

       $element->add_control(
                'e_custom_class' ,
                [
                    'label' => esc_html__( 'CSS Classes', 'elemailer' ),
                    'classes' => 'elemailer-section-control',
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'myclass myclass2', 'elemailer' ),
                    'prefix_class' => '', //needs to be here to make the changes live
                    //'classes' => 'elementor-control-direction-ltr',
                    'ai' => [
                        'active' => false,
                    ],

                ]
        );

    }
}
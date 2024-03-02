<?php
namespace Elemailer\Lib\Database;

defined( 'ABSPATH' ) || exit;

/**
 * database related base class for initialization
 * 
 * @author elEmailer
 * @since 1.0.0
 */
Class Base{

    use \Elemailer\Traits\Singleton;

    /**
     * initialization function for database
     *
     * @return void
     * @since 1.0.0
     */
    public function init(){
        // keep this for future needs
    }
    
    /**
     * table create on database function
     *
     * @return void
     * @since 1.0.0
     */
    public function create_tables(){
        Create_table::instance()->init();
    }

}
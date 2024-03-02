<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blog extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('franquia', FALSE, 'blog', array(
            'header_class'  =>  '-dark -sticky-dark js-header-dark js-header',
            'main_class'    =>  'bg-dark-1'
        ));
    }
    
    public function detalhes($link){
        $this->makePage('franquia', FALSE, 'blog_detalhes', array(
            'header_class'  =>  '-dark -sticky-dark js-header-dark js-header',
            'main_class'    =>  'bg-dark-1'
        ));
    }
}
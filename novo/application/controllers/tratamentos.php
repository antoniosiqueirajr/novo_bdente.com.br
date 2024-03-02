<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tratamentos extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tratamento');
    }
    
    public function index(){
        $this->makePage('clinicas', FALSE, 'tratamentos', array(
            'tratamentos'   =>  $this->tratamento->get_all(FALSE,array('ordem','asc')),
        ));
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quem_somos extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('empresa');
    }
    
    public function index(){
        $this->makePage('clinicas', FALSE, 'quem_somos', array(
            'empresa'       =>  $this->empresa->get(array('id'=>1)),
        ));
    }
}
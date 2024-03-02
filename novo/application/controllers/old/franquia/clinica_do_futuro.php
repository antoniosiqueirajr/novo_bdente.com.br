<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clinica_do_futuro extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('franquia', FALSE, 'clinica_do_futuro', array());
    }
}
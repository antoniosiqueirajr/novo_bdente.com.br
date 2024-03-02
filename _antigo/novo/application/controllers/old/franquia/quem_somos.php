<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quem_somos extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('franquia', FALSE, 'quem_somos', array());
    }
}
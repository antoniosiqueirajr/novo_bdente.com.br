<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class empreendedor_de_sucesso extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('franquia', FALSE, 'empreendedor_de_sucesso', array());
    }
}
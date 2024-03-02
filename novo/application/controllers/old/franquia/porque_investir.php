<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class porque_investir extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('franquia', FALSE, 'porque_investir', array());
    }
}
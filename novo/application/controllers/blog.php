<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blog extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('clinicas', FALSE, 'blog', array(
        ));
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class privacidade extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->makePage('clinicas', FALSE, 'privacidade', array());
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class empresa extends B10_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function table_name() {
        return 'portal.empresa';
    }
}
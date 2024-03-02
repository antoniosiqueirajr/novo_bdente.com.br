<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class banner extends B10_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function table_name() {
        return 'portal.banner';
    }
    
    public function get_all_ativos($where = array()){
        $now = date('Y-m-d');
        return $this->get_all(array_merge(array(
            'data_inicial <='   => $now,
            'data_final >='   => $now,
        ),$where));
    }
}
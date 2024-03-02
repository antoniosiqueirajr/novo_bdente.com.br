<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servico_item extends B10_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function table_name() {
        return 'portal.servico_item';
    }
    
    
    public function get_all_por_servico(){
        $itens = array();
        foreach($this->get_all() as $item){
            $itens[$item->servico][] = $item;
        }
        return $itens;
    }
}
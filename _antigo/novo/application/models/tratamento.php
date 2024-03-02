<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tratamento extends B10_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function table_name() {
        return 'portal.tratamento';
    }
    
    public function get_menu(){
        $retorno = array();
        $tratamentos = $this->get_all(FALSE,array('ordem','asc'));
        foreach($tratamentos as $tratamento){
            $retorno[$tratamento->categoria][] = $tratamento;
        }
        return $retorno;
    }
}
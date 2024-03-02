<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unidades extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('unidade');
        $this->load->model('estado');
    }
    
    public function index(){
        $this->makePage('clinicas', FALSE, 'unidades', array(
            'estados'   =>  db_array($this->estado->get_all(),'uf','nome'),
            'unidades'  =>  $this->unidade->get_unidades_por_uf(),
        ));
    }
    
    public function detalhes($link){
        $this->makePage('clinicas', FALSE, 'unidades_detalhes', array(
            'unidade' => $this->unidade->get(array('link'=>$link)),
            'unidades' => $this->unidade->get_all(),
        ));
    }
}
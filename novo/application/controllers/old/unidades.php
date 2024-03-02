<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unidades extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('estado');
        $this->load->model('unidade');
    }
    
    public function index(){
        $dados  =   array(
            'estados'   =>  db_array($this->estado->get_all(),'uf','nome'),
            'unidades'  =>  $this->unidade->get_unidades_por_uf(),
        );
        $this->makePage('clinicas', FALSE, 'unidades', $dados);
    }
    
    public function detalhes($link){
        $unidade    =   $this->unidade->get(array('link'=>$link));
        if(!is_object($unidade)){
            mensagem('Unidade não encontrada');
            redirect('unidades');
        }
        $this->makePage('clinicas', FALSE, 'home', array(
            'unidade'   =>  $unidade,
            'estados'   =>  db_array($this->estado->get_all(),'uf','nome'),
            'unidades'  =>  $this->unidade->get_unidades_por_uf(),
        ));
    }
}
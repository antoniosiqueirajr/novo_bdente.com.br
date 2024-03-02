<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fale_conosco extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $input      =   $this->se->get_filter();
        if($input){
            $this->load->library('email');
            $this->email->to('contato@benepop.com.br');
            $this->email->bcc('ajuda@siqueirajr.com');
            $this->email->bcc('julio@benepop.com.br');
            $this->email->subject('BenePop Fale Consosco');
            $this->email->view('formulario_fale_conosco',$input);
            $this->email->send();
            $this->email->clear(TRUE);
            mensagem('Obrigado sua dúvida foi enviada com sucesso! Em breve entraremos em contato!');
            redirect(uri_string());
        }
        $this->makePage('clinicas', FALSE, 'fale_conosco', array());
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fale_conosco extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $input      =   $this->se->get_filter();
        if($input){
            $this->load->library('email');
            $this->email->to('atendimento@benepop.com.br');
            $this->email->bcc('ti@benepop.com.br');
            $this->email->bcc('ajuda@siqueirajr.com');
            $this->email->bcc('antonio@siqueirajr.com');
            $this->email->subject('Formulário fale conosco preenchido na página de franquias.');
            $this->email->view('formulario_fale_conosco',$input);
            $this->email->send();
            $this->email->clear(TRUE);
            mensagem('Seu e-mail foi envaido com sucesso!');
            redirect(uri_string());
        }
        $this->makePage('franquia', FALSE, 'fale_conosco', array());
    }
}
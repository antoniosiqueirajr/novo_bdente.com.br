<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends B10_Controller{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $input  =   $this->se->get_filter();
        if($input){
            $this->load->library('email');
            $this->email->to('expansao@benepop.com.br');
            $this->email->cc('antonio@benepop.com.br');
            $this->email->cc('julio@benepop.com.br');
            $this->email->bcc('antonio@siqueirajr.com');
            $this->email->subject('Formulário flutuante de franquias foi preenchido.');
            $this->email->view('formulario_flutuantes_franquias',$input);
            $this->email->send();
            $this->email->clear(TRUE);
            mensagem('Seu e-mail foi envaido com sucesso!');
            redirect(uri_string());
        }
        $this->makePage('franquia', FALSE, 'home', array(
            'header_class'  =>  '-dark -sticky-dark js-header-dark js-header',
            'main_class'    =>  ''
        ));
    }
    
    public function formulario_franquia(){
        $input  =   $this->se->get_filter();
        $this->load->library('email');
        $this->email->to('expansao@benepop.com.br');
        $this->email->bcc('ti@benepop.com.br');
        $this->email->bcc('ajuda@siqueirajr.com');
        $this->email->bcc('antonio@siqueirajr.com');
        $this->email->subject('Novo lead de franquia cadastrado no site.');
        $this->email->view('formulario_franquia',$input);
        $this->email->send();
        $this->email->clear(TRUE);
        
        $this->email->to($input['email']);
        $this->email->bcc('ajuda@siqueirajr.com');
        $this->email->bcc('antonio@siqueirajr.com');
        $this->email->subject('Obrigado por nos contactar!');
        $this->email->view('confirmacao_franquia',$input);
        $this->email->send();
        $this->email->clear(TRUE);
        mensagem('Seu e-mail foi enviado com sucesso!');
        redirect('franquia');
    }
    
    public function formulario_diretor(){
        $input  =   $this->se->get_filter();
        $this->load->library('email');
        $this->email->to('expansao@benepop.com.br');
        $this->email->bcc('ti@benepop.com.br');
        $this->email->bcc('ajuda@siqueirajr.com');
        $this->email->bcc('antonio@siqueirajr.com');
        $this->email->subject('Nova mensagem para o Presidente enviada pelo site.');
        $this->email->view('formulario_diretor',$input);
        $this->email->send();
        mensagem('Seu e-mail foi enviado com sucesso!');
        redirect('franquia');
    }
}
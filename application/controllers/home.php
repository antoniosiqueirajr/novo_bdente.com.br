<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends B10_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('estado');
        $this->load->model('unidade');
        $this->load->model('banner');
        $this->load->model('empresa');
        $this->load->model('tratamento');
        $this->load->model('servico');
        $this->load->model('servico_item');
        $this->load->model('implante');
        $this->load->model('depoimento');
        $this->load->model('blog');
    }
    
    public function index(){
        $this->makePage('clinicas', FALSE, 'index', array(
//            'estados'       =>  db_array($this->estado->get_all(),'uf','nome'),
            'unidades'      =>  $this->unidade->get_all(),
            'banners'       =>  $this->banner->get_all_ativos(),
//            'empresa'       =>  $this->empresa->get(array('id'=>1)),
            'tratamentos'   =>  $this->tratamento->get_all(FALSE,array('ordem','asc'),array('start'=>0,'lenght'=>5)),
//            'servicos'      =>  $this->servico->get_all(),
//            'servico_itens' =>  $this->servico_item->get_all_por_servico(),
//            'implantes'     =>  $this->implante->get(array('id'=>1)),
            'depoimentos'   =>  $this->depoimento->get_all(),
//            'noticias'      =>  $this->blog->get_noticias(array('pagina <>'=>2)),
            'cases'      =>  $this->blog->get_all(array('categoria'=>4),array('data','desc'),array('start'=>0,'lenght'=>5)),
        ));
    }
    
    public function not_found() {
        $url    =   uri_string();
        if(strpos($url, 'franquia') === 0){
            $contexto   =   'franquia';
        }
        else{
            $contexto   =   'clinicas';
        }
        $dados  =   array(
            'body'  =>  $this->load->view('comum/not_found',array('url'=>$url,'contexto'=>$contexto),TRUE)
        );
        $this->makePage($contexto, FALSE, FALSE, $dados);
    }
    
    public function formulario_agenda(){
        $input      =   $this->se->get_filter();
        $unidade    =   $this->unidade->get(array('id'=>$input['unidade']));
        $this->load->library('email');
        $this->email->to($unidade->email);
        $this->email->bcc('ti@benepop.com.br');
        $this->email->bcc('ajuda@siqueirajr.com');
        $this->email->bcc('antonio@siqueirajr.com');
        $this->email->subject('Novo agendamento cadastrado no site.');
        $this->email->view('formulario_agenda',array_merge($input,array('unidade'=>$unidade)));
        $this->email->send();
        $this->email->clear(TRUE);
        
        mensagem('Seu e-mail foi envaido com sucesso!');
        redirect();
    }
    
    
    public function teste_email($modelo){
        $unidade = new stdClass();
        $unidade->responsavel = 'responsavel';
        $unidade->uf = 'estado';
        $unidade->nome = 'cidade';
        
        $this->load->library('email');
        $this->email->to('suporte@b10web.com.br');
        $this->email->subject('Teste de email');
        $this->email->view($modelo,array(
            'nome'      =>  'JOÃO',
            'sobrenome' =>  'Silva',
            'email'     =>  'joao@joao.com',
            'telefone'  =>  '(43) 99647-9420',
            'mensagem'  =>  'OIE',
            'unidade'   =>  $unidade,
            'cidade'    =>  'cidade',
            'uf'        =>  'estado',
            'assunto'   =>  'Assunto'
        ));
        $this->email->send();
    }
}
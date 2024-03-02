<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User {
    
    private $CI;
    private $user;
    private $permissions;
    
    public function __construct() {
        $this->CI =& get_instance();
        
        //Models
        
        
        //Setup
        if ($this->CI->session->userdata('permissions') !== FALSE){
            $this->permissions = $this->CI->session->userdata('permissions');
        }
        if ($this->CI->session->userdata('user') !== FALSE){
            $this->user = $this->CI->session->userdata('user');
        }
        else{
            $this->user = array(
                'status' => '0',
            );
        }
        
        $controller=$this->CI->uri->segment(1);
        $method=$this->CI->uri->segment(2);
        
        if(!is_array($this->permissions)){
            if($controller !== 'index'){
                //redirect();
                echo $controller;
            }
        }
        else{
            if(!$this->allow_access($controller,$method)){
                mensagem('Você não tem permissão para ver a página solicitada.');
                redirect('home');
            }
        }
    }
    
    public function login($login,$senha){
        $this->CI->load->model('usuario');
        
        $usuario = $this->CI->usuario->login($login,$senha);
        if(is_array($usuario)){
            if($usuario['cliente'] == '1'){
                $usuario['interno'] = TRUE;
            }
            else{
                $this->CI->load->model('cliente');
                $cliente = $this->CI->cliente->get_array(array('id'=>$usuario->cliente));
                $usuario['cliente_data'] = $cliente;
                $usuario['interno'] = FALSE;
            }
            
            
            $this->CI->load->model('permissao');
            
            
            if($usuario->superadmin == '1'){
                foreach($this->CI->permissao->get_all() as $permissao){
                    $permissoes[$permissao->controller][$permissao->method] = TRUE;
                }
            }
            else{
                $this->CI->load->model('usuario_permissao');
                foreach($this->CI->usuario_permissao->get_all(array('usuario'=>$usuario->id)) as $permitido){
                    $permitidos[$permitido->id] = TRUE;
                }
                foreach($this->CI->permissao->get_all() as $permissao){
                    if(isset($permitidos[$permissao->id])){
                        $permissoes[$permissao->controller][$permissao->method] = TRUE;
                    }
                    else{
                        $permissoes[$permissao->controller][$permissao->method] = FALSE;
                    }
                }
            }
            $this->set_user($usuario);
            $this->set_permissions($permissoes);
        }
        
        
        $this->CI->load->model('usuario_permissao');
        $this->CI->load->model('permissao');
    }
    
    public function logoff(){
        
    }
    
    function get_user($attr = FALSE){
        if($attr === FALSE){
            return $this->user;
        }
        else{
            if(isset($this->user[$attr])){
                return $this->user[$attr];
            }
            else{
                return FALSE;
            }
        }
    }
    
    private function set_user($usuario){
        $this->user = $usuario;
        $this->CI->session->set_userdata('user',$usuario);
    }
    
    private function set_permissions($permissoes){
        $this->permissions = $permissoes;
        $this->CI->session->set_userdata('permissions',$permissoes);
    }
    
    public function get_permissions(){
        return $this->permissions;
    }


    public function allow_access($controller,$method){
        $permissions = $this->get_permissions();
        if(!isset($permissions[$controller][$method])){
            return TRUE;
        }
        else{
            return $permissions[$controller][$method];
        }
    }
    
    public function is_logged(){
        if($this->user['status'] == '0'){
            return FALSE;
        }
        return TRUE;
    }
}

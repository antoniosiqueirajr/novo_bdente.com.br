<?php
    class User_control{
        private $user_model='usuario';
        private $user_permission_model='usuario_permissao';
        private $permission_model='permissao';
        private $session_user_id='user_id';
        
        public function __construct() {
            
        }
        
        private function load_models(){
            $CI =& get_instance();
            $CI->load->model($this->user_model);
            $CI->load->model($this->permission_model);
            $CI->load->model($this->user_permission_model);
        }
        
        public function set_user_model($user_model){
            if(is_dir('../model/'.$user_model)){
                $this->user_model=$user_model;
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        public function set_permission_model($permission_model){
            if(is_dir('../model/'.$permission_model)){
                $this->user_model=$permission_model;
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        public function set_user_permission_model($user_permission_model){
            if(is_dir('../model/'.$user_permission_model)){
                $this->user_model=$user_permission_model;
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        
        public function set_session_user_id($session_user_id){
            $this->session_user_id($session_user_id);
            return TRUE;
        }
        
        public function get_user(){
            $this->load_models();
            $CI =& get_instance();
            
            $user_model=$this->user_model;
            $session_user_id=$this->session_user_id;
            
            return $CI->$user_model->get(array('id'=>$CI->session->userdata($session_user_id)));
        }
    }
    
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blog extends B10_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function table_name() {
        return 'portal.blog';
    }
    
    public function get_noticias($where){
        $this->db->join('portal.blog_categoria','blog_categoria.id = blog.categoria');
        $this->db->select('blog.*, blog_categoria.nome AS categoria_nome');
        return $this->get_all($where, array('data','desc'), array('start'=>0,'lenght'=>3));
    }
}
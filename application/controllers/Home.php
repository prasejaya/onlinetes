<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    var $akses;
    public function __construct() {
        parent::__construct();
        $this->akses=gate_check();
    }

    public function index() {
        $this->load->library('urlencrypt');
        $this->load->helper('text');
        
        //print_r($this->session->userdata());
        $data['page_name']='Home';
        $data['page_breadcrumb'] = array('Home' => array('url' => base_url('home'), 'active' => 'active'));
        
        $this->template->load('theme1', 'theme1/home', $data);
    }
    
    public function detailpengumuman($idpengumuman) {
        $this->load->model('m_pengumuman');
        $this->load->library('urlencrypt');
        $this->load->helper('text');
        $data['pengumuman']=$this->m_pengumuman->get_one('id_pengumuman, judul, jenis, isi, gambar, file, dilihat',$this->urlencrypt->decode($idpengumuman));
        //print_r($data['pengumuman']);
        $dilihat=$data['pengumuman']['dilihat']+1;
        $this->m_pengumuman->update(array('dilihat'=>$dilihat),$data['pengumuman']['id_pengumuman']);
        
        $data['akses_insert']=$this->akses['i'];
        $data['page_list']=base_url('pengumuman');
        $data['page_name']='Detail Pengumuman';
        $data['page_breadcrumb'] = array('Home' => array('url' => base_url('home')),
            'Detail Pengumuman' => array('url' => base_url('#'), 'active' => 'active'));
        
        $this->template->load('theme1', 'theme1/detailpengumuman', $data);
    }
}

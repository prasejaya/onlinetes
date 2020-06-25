<?php 
class Error404 extends CI_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
 } 

 public function index() {
        $data['logo']="logo.png";
        $data['namasingkat']="People Development Consultant";
        $this->load->view('theme1/error404', $data);
    }
    public function denied() {
        $data['logo']="logo.png";
        $data['namasingkat']="People Development Consultant";
        $this->load->view('theme1/denied', $data);
    }
} 
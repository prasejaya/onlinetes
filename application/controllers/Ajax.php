<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            echo 'No access';
            die();
        }
    }

    public function get_provinsi($keyword = '') {
        $this->load->model('m_combo');
        $data = $this->m_combo->provinsi($keyword);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['NAMA'],
                'id' => $row['IDPROP'],
            );
        }
        echo json_encode($arr);
    }

    public function get_kabupaten($keyword = '', $idprov='') {
        $this->load->model('m_combo');
        $data = $this->m_combo->kabupaten($keyword, $idprov);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['NAMA'],
                'id' => $row['KAB'],
            );
        }
        echo json_encode($arr);
    }

    public function get_kecamatan($keyword = '', $idprov='', $idkab='') {
        $this->load->model('m_combo');
        $data = $this->m_combo->kecamatan($keyword, $idprov, $idkab);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['NAMA'],
                'id' => $row['KEC'],
            );
        }
        echo json_encode($arr);
    }

    public function get_desa($keyword = '', $idprov='', $idkab='', $idkec='') {
        $this->load->model('m_combo');
        $data = $this->m_combo->desa($keyword, $idprov, $idkab, $idkec);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['NAMA'],
                'id' => $row['IDDESA'],
            );
        }
        echo json_encode($arr);
    }
    
    public function get_pengaju($keyword){
        $this->load->model('m_pengaju');
        $data = $this->m_pengaju->get_comboajax($keyword);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['noktp'].' - '.$row['nama'],
                'id' => $row['id_pengaju'],
            );
        }
        echo json_encode($arr);
    }
    
    public function get_pjsalur($keyword){
        $this->load->model('m_pjsalur');
        $data = $this->m_pjsalur->get_comboajax($keyword);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['nama'],
                'id' => $row['id_pjsalur'],
            );
        }
        echo json_encode($arr);
    }
    public function get_nmrekomendasi($keyword){
        $this->load->model('m_proposal');
        $data = $this->m_proposal->get_nmrekomendasiajax($keyword);
        foreach ($data as $row) {
            $arr[] = array(
                'value' => $row['nmrekomendasi'],
                'id' => $row['nmrekomendasi'],
            );
        }
        echo json_encode($arr);
    }
    public function get_one_anakproposal(){
        $this->load->model('m_anakproposal');
        $this->load->library('urlencrypt');
        $id=$this->urlencrypt->decode($this->input->post('id_anakproposal'));
        $data=$this->m_anakproposal->get_one('id_anakproposal, foto, nama, jk, tmplahir, tgllahir, ap.id_sekolah, sekolahkelas',$id);
        $data['previewfoto']= create_image('uploads/fotoanak/', $data['foto'],'img-responsive','200','margin: 0 auto;').'<br>';
        echo json_encode($data);
    }

}

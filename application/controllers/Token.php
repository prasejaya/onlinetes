<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

    var $akses;

    public function __construct() {
        parent::__construct();
        $this->akses = gate_check();
    }

    public function index() {
        
        $this->load->library('datatables');
        $this->load->library('formbuilder');
        $this->load->helper('form');
        $this->load->model('m_instansi');

        //$data['page_insert']=base_url('peserta/tambahpeserta');
        $data['nama_tomboltambah']='Generate token';
        $data['page_name'] = 'Data Token';
        $data['page_post'] = base_url('token/generatetoken');
        $data['page_breadcrumb'] = array(
            'Token' => array('url' => base_url('token'), 'active' => 'active'));

        $data['kolom'] = array('id_peserta' => '',
            'namainstansi' => 'Instansi',
            'token' => 'Token',
            'tes' => 'Jenis Tes');
        $a_tespapi = array('id' => 'papi',
                'value' => 'papi',
                'label' => 'Tes Papi',
                'validation' => 'required',);
        $a_tesdesc = array('id' => 'desc',
                'value' => 'desc',
                'label' => 'Tes Desc',
                'validation' => 'required',);
        $a_tesbelbin = array('id' => 'belbin',
                'value' => 'belbin',
                'label' => 'Tes Belbin',
                'validation' => 'required',);
        $a_tesleader = array('id' => 'leader',
                'value' => 'leader',
                'label' => 'Tes Leadership',
                'validation' => 'required',);
            
        $data['datavalue'] = array('jumlah'=>'1');
        $data['formdata'][] = array('id' => 'jumlah', 'label' => 'Jumlah Token :', 'validation' => 'required|numeric|max_length[3]');
        $data['formdata'][] = array('id' => 'id_instansi', 'type' => 'dropdown', 'options' => array(''=>'--kosong--')+$this->m_instansi->get_combo(), 'label' => 'Instansi :', 'validation' => 'required');
        $data['formdata'][] = array('id' => 'tes[]', 'label' => 'Jenis Tes', 'type' => 'checkbox', 'options' => array($a_tespapi,$a_tesdesc,$a_tesbelbin,$a_tesleader), 'validation' => 'required');
        
        //hak akses
        if ($this->akses['u'] || $this->akses['d']) {
            $data['kolom']['aksi'] = 'Aksi';
        }
        $data['akses_insert']=$this->akses['i'];

        $indexaksi = count($data['kolom']) - 1;
        $data['customjs'] = $this->datatables->generate_js(base_url('token/datatabletoken'), $data['kolom'], $indexaksi, null, false);

        if ($this->akses['d'])
            $data['customjs'] .= $this->datatables->generate_jsdelete(base_url('token/hapustoken'));

        $this->template->load('theme1', 'theme1/list_token', $data);
    }
    
    function generatetoken(){
        
        $this->load->model('m_peserta');
        if ($this->input->post()) {
            $jumlah=intval($this->input->post('jumlah'));
            if($this->input->post('id_instansi')=='')
                $instansi=null;
            else
                $instansi=$this->input->post('id_instansi');
            $tes = implode(',',$this->input->post('tes') );
            
            if($jumlah>0){
                for($i=0;$i<$jumlah;$i++){
                    
                    $data[]=array('token'=>$this->_random_token(),
                            'id_instansi'=>$instansi,
                            'tes'=>$tes,
                            'log_time' => date('Y-m-d H:i:s'),
                            'log_timeinsert' => date('Y-m-d H:i:s'),
                            'log_act' => 'generate-token',
                            'log_ip' => $_SERVER['REMOTE_ADDR'],
                            'log_ref' => $this->router->fetch_class() . '/' . $this->router->fetch_method()
                            );
                }
                $hasil=$this->m_peserta->insert_batch($data);
                
                if($hasil > 0){
                    
                    $this->session->set_flashdata('info', 'Berhasil generate '.$jumlah.' Token!');
                }else{
                    $this->session->set_flashdata('error', 'Terjadi kesalahan generate token!');
                }
            }else{
                $this->session->set_flashdata('error', 'Jumlah harus minimal 1');
            }
        } else {
            $this->session->set_flashdata('error', 'Tidak dapat generate token!');
        }
        redirect(base_url('token'));
    }
    
    function _random_token() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randomtext = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alpha_length);
            $randomtext[] = $alphabet[$n];
        }
        return implode($randomtext);
    }

    public function datatabletoken() {
        $this->load->model('m_peserta');
        $this->load->library('urlencrypt');
        $this->load->helper('text');

        $is_token=true;
        $list = $this->m_peserta->get_datatables($is_token);
        $data = array();
        //$no = $this->input->post('start'); //isset($_POST['start'])? $_POST['start']: '0';
        foreach ($list as $field) {
            //$no++;
            $row = array('id_peserta' => $field->id_peserta,
                'namainstansi' => $field->namainstansi,
                'token' => $field->token);
            $row['aksi']='';
            if ($this->akses['d'])
                $row['aksi'] .= ' &nbsp; <a  onclick="hapusdata(' . "'" . $this->urlencrypt->encode($field->id_peserta) . "'" . ')" title="hapus token"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i> Hapus token</button></a>';
            
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'), //isset($_POST['draw'])? $_POST['draw']: '0',
            "recordsTotal" => $this->m_peserta->count_all(),
            "recordsFiltered" => $this->m_peserta->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    
    public function hapustoken() {
        
        $this->load->model('m_peserta');
        $this->load->library('valid');
        if ($this->input->post()) {
            $this->load->library('urlencrypt');
            
            $id = $this->urlencrypt->decode($this->input->post('idtable'));
            
            $data = $this->m_peserta->get_one_token('*', $id);
            //note: sebelum hapus cek ulang apakah sudah digunakan
            if($data['nama']==''||$data['jk']==''||$data['tgllahir']==''||$data['telp']==''||$data['email']==''||$data['pekerjaan']==''){
                $upload_setting = array();
                $this->valid->delete('m_peserta', $data, $upload_setting);
            }else{
                $this->session->set_flashdata('error', 'Data token sudah digunakan, tidak dapat di hapus!');
            }
        } else {
            $this->session->set_flashdata('error', 'Tidak dapat mengambil ID!');
        }
        redirect(base_url('token'));
    }
    

}

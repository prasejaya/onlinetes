<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('myhelper','cookie','string'));
    }

    public function index() {
        $this->load->library('formbuilder');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('m_user');
        $data['formdata'][] = array('id' => 'username', 'label' => 'Username :', 'validation' => 'trim|required|min_length[1]|max_length[100]|strip_tags', 'class' => 'validate');
        $data['formdata'][] = array('id' => 'password', 'type' => 'password', 'label' => 'Password :', 'validation' => 'trim|required|min_length[1]|max_length[100]|strip_tags');
        $data['logo']="logo.png";
        $seting=array('logo'=>'logo.png','namasingkat'=>'');
        if ($this->input->post()) {
            $this->load->library('valid');
            $hasilcek=$this->valid->cek_form($data['formdata']);
            
            if ($hasilcek['status']) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $rememberme = $this->input->post('rememberme');
                $where = array(
                    'is_active'=>'1',
                    'username' => $username,
                    'password' => md5($this->config->item('salt1') . $password . $this->config->item('salt2'))
                );

                $datauser = $this->m_user->cek_login($where);
                if (!$datauser) {
                    $this->session->set_flashdata('error', 'Login gagal, cek username dan password!');
                } else {
                    //jika remember me di centang
                    if ($rememberme) {
                        $key = random_string('alnum', 50);
                        set_cookie('chocochips', $key, 3600*24*30); 

                        // simpan key di database
                        $update_key = array(
                            'cookie' => $key
                        );
                        $this->m_user->update($update_key, $datauser['id_user']);
                    }

                    //membuat array role
                    $role=$this->_getrole($datauser['tipeuser']);

                    $data_session = array(
                        'namauser' => $datauser['nama'],
                        'id_user' => $datauser['id_user'],                
                        'tipeuser' => $datauser['tipeuser'],            
                        'role'=>$role,
                        'seting'=>$seting
                    );
                    $this->session->set_userdata($data_session);

                    //insert log login
                    $this->load->model('m_loglogin');
                    $datalog['id_user']=$datauser['id_user'];
                    $datalog['log_time'] = date('Y-m-d H:i:s');
                    $datalog['log_act'] = 'login';
                    $datalog['log_ip'] = $_SERVER['REMOTE_ADDR'];
                    $datalog['log_ref'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
                    $datalog['jenislog'] = 'login';
                    $this->m_loglogin->insert($datalog);

                    redirect(base_url('home'));
                    die();
                }
            } else {
                $data['formdata'] = $hasilcek['form'];
            }
        } else {
            
            // ambil cookie
            $cookie = get_cookie('chocochips');

            // cek session
            if ($this->session->userdata('id_user')) {
                redirect('home');
                die();
            } else if($cookie <> '') {
                // cek cookie
                $where = array(
                    'cookie' => $cookie
                );
                $datauser = $this->m_user->cek_login($where);
                if ($datauser) {
                    
                    //membuat array role
                    $role=$this->_getrole($datauser['tipeuser']);
                    
                    $data_session = array(
                        'namauser' => $datauser['nama'],
                        'id_user' => $datauser['id_user'],                
                        'tipeuser' => $datauser['tipeuser'],  
                        'role'=>$role,
                        'seting'=>$seting
                    );
                    $this->session->set_userdata($data_session);
                    
                    //insert log login
                    $this->load->model('m_loglogin');
                    $datalog['id_user']=$datauser['id_user'];
                    $datalog['log_time'] = date('Y-m-d H:i:s');
                    $datalog['log_act'] = 'login';
                    $datalog['log_ip'] = $_SERVER['REMOTE_ADDR'];
                    $datalog['log_ref'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
                    $datalog['jenislog'] = 'login-cookies';
                    $this->m_loglogin->insert($datalog);
                    
                    redirect(base_url('home'));
                    die();
                }
            }
        }
        $this->load->view('theme1/login', $data);
    }
    
    public function _getrole($tipeuser){
        $this->load->model('m_menu');
        $result=$this->m_menu->view_role($tipeuser);
        $role=array();
        foreach ($result as $value) {
            $role[$value['id_menu'].'|'.$value['url']]['i']=$value['i'];
            $role[$value['id_menu'].'|'.$value['url']]['u']=$value['u'];
            $role[$value['id_menu'].'|'.$value['url']]['d']=$value['d'];
            $role[$value['id_menu'].'|'.$value['url']]['v']=$value['v'];
        }
        return $role;
    }

    public function logout() {
        $this->session->sess_destroy();
        delete_cookie('chocochips');
        $this->session->set_flashdata('notif', '<strong>Anda berhasil keluar!</strong>');
        //insert log login
        $this->load->model('m_loglogin');
        $datalog['id_user']=$this->session->userdata('id_user');
        $datalog['log_time'] = date('Y-m-d H:i:s');
        $datalog['log_act'] = 'login';
        $datalog['log_ip'] = $_SERVER['REMOTE_ADDR'];
        $datalog['log_ref'] = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $datalog['jenislog'] = 'logout';
        $this->m_loglogin->insert($datalog);
        redirect(base_url());
    }

    public function gantipassword() {
        $this->load->library('template');
        $this->load->library('formbuilder');
        $this->load->helper('form');
        $this->load->model('m_user');

        $id=$this->session->userdata('id_user');
        $data['datavalue'] = $this->m_user->get_one('id_user, nama, username, password', $id);
       
        //form
        $data['formdata'][] = array('id' => 'passwordlama', 'type' => 'password', 'label' => 'Password Lama:', 'validation' => 'required|trim|callback_oldpassword_check');
        $data['formdata'][] = array('id' => 'passwordbaru', 'type' => 'password', 'label' => 'Password Baru:', 'validation' => 'required|trim|matches[password]');
        $data['formdata'][] = array('id' => 'password', 'type' => 'password', 'label' => 'Ulangi Password Baru:', 'validation' => 'required|trim|matches[passwordbaru]');
        $data['formdata'][] = array('id' => 'submit', 'type' => 'submit', 'label' => 'Ganti', 'class' => 'pull-right', );

        $data['page_post']='auth/gantipassword';
        $data['page_name']='Ganti Password';
        $data['page_breadcrumb'] = array('Ganti Password' => array('url' => base_url('auth/gantipassword'), 'active' => 'active'));

        //taruh di atas form supaya bisa ambil form_error
        if ($this->input->post()) {
            $this->load->library('valid');
            
            //untuk tambahan data di belakang layar
            $datacustom = array(); //user session
            //untuk menghilangkan inputan dan tidak ikut ter insert
            $exception = array('submit','passwordlama','passwordbaru');

            $result_valid = $this->valid->update($data['formdata'], 'm_user', 'edit-password', $datacustom, $exception,$data['datavalue']);

            if ($result_valid['status_proses']) {
                $this->session->set_flashdata('info', 'Berhasil merubah password!');
                redirect(base_url('auth/gantipassword'));
            }else 
                $this->session->set_flashdata('error', 'Gagal merubah password!');
            
            if($result_valid['form']);

            //overide form untuk message
            $data['formdata'] = $result_valid['form'];
            $data['datavalue'] = $result_valid['datavalue'];
        }

        $this->template->load('theme1', 'theme1/include/form', $data);
    }
    
    public function oldpassword_check($old_password){
        
        if($this->session->userdata('id_user') == ""){
            $this->form_validation->set_message('oldpassword_check', 'Anda tidak memiliki akses!');
            return FALSE;
        }else{
            $this->load->model('m_user');
            $id=$this->session->userdata('id_user');
            
            $old_password_hash = md5($this->config->item('salt1').$old_password.$this->config->item('salt2'));
            $old_password_db_hash = $this->m_user->get_one('password',$id)['password'];

            if($old_password_hash != $old_password_db_hash)
            {
               $this->form_validation->set_message('oldpassword_check', 'Isian "Password Lama :" Password lama tidak cocok!');
               return FALSE;
            } 
            return TRUE;
        }
     }

}

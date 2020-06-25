<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Urlencrypt {

    var $ci;
    var $encryption_key="s3pty4nnurdi4nsy" ;
    var $iv="0813345009911234" ;
    var $encryption_mechanism="aes-256-cbc";

    function __construct() {
        $this->ci = & get_instance();
    }
    
    public function encode($value) {

        return $this->newencode($value);
    }

    public function decode($value) {

        return $this->newdecode($value);
    }

    public function safe_b64encode($string) {

        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    //CI menggunakan mcrypt tetapi depracated di php 7.0 untuk itu di gandi menggunakan base 64 aja
    public function defaultencode($string) {
        $this->ci->load->library('encrypt');
        $data = $this->ci->encrypt->encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', '~'), $data);
        return $data;
    }

    public function defaultdecode($string) {
        $this->ci->load->library('encrypt');
        $string = str_replace(array('-', '_', '~'), array('+', '/', '='), $string);
        $data = $this->ci->encrypt->decode($string);
        return $data;
    }

    function newencode($string) {
        $output = false;
        $secret_key = $this->encryption_key;
        $secret_iv = $this->iv;
        $encrypt_method = $this->encryption_mechanism;
        // hash
        $key = hash("sha256", $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash("sha256", $secret_iv), 0, 16);
        //do the encryption given text/string/number
        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
    }

    function newdecode($string) {
        $output = false;
        $secret_key = $this->encryption_key;
        $secret_iv = $this->iv;
        $encrypt_method = $this->encryption_mechanism;
        // hash
        $key = hash("sha256", $secret_key);
        // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
        $iv = substr(hash("sha256", $secret_iv), 0, 16);
        //do the decryption given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

}

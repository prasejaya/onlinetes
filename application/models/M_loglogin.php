<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_loglogin extends CI_Model {

    private $table = "set_loglogin";
    public $tableid = "id_loglogin";
    

    function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

}

?>
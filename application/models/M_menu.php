<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_menu extends CI_Model {

    private $table = "set_menu";
    public $tableid = "id_menu";
    
    function update($data, $id) {
        $this->db->where($this->tableid, $id);
        $this->db->update($this->table, $data);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    function delete($id) {
        $this->db->where($this->tableid, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    
    function get_one($kolom,$id){
        $this->db->select($kolom); 
        $this->db->from($this->table);
        $this->db->where($this->tableid, $id);
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
    }
    
    function view_sitemenu($tipeuser,$parent){
        $strquery="SELECT m.id_menu, m.nama, m.url, m.icon_pack, m.icon_image, Deriv1.child 
                    FROM {$this->table} m  
                    LEFT OUTER JOIN (
                    SELECT id_menuparent, COUNT(*) AS child FROM {$this->table} GROUP BY id_menuparent)
                    Deriv1 ON m.id_menu = Deriv1.id_menuparent WHERE m.id_menuparent='$parent' and id_menu<>0 and tipeuser='$tipeuser'order by m.urutan";
        //echo $strquery.'<hr>';
        $query = $this->db->query($strquery);
        return $query->result_array();
    }
    
    function view_sitemenuarr($tipeuser){
        $strquery="SELECT m.id_menu, m.nama, m.url, m.icon_pack, m.icon_image, Deriv1.child 
                    FROM {$this->table} m  
                    LEFT OUTER JOIN (
                    SELECT id_menuparent, COUNT(*) AS child FROM {$this->table} GROUP BY id_menuparent)
                    Deriv1 ON m.id_menu = Deriv1.id_menuparent WHERE id_menu<>0 and tipeuser='$tipeuser'order by m.urutan";
        //echo $strquery.'<hr>';
        $query = $this->db->query($strquery);
        return $query->result_array();
    }
    
    function view_role($tipeuser){
        $this->db->select('id_menu,url, i, u, d, v');
        $this->db->where('tipeuser', $tipeuser);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}

?>
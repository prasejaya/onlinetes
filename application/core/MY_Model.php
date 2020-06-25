<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $table = "";
    public $tableid = "";
    
    public $column_order = array(); //field yang ada di table user
    public $column_search = array(); //field yang diizin untuk pencarian 
    public $order = array(); // default order 
    public $combo=array();
 
    function update($data, $id) {
        $this->db->where($this->tableid, $id);
        $this->db->update($this->table, $data);
        
        return $this->db->affected_rows();
    }

    function insert($data) {
        $this->db->insert($this->table, $data);
        //return $this->db->affected_rows();
        return array('affected_row'=>$this->db->affected_rows(),
            'insert_id'=>$this->db->insert_id());
    }

    function delete($id) {
        
        $this->db->where($this->tableid, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    
    function get_one($kolom,$id){
        $this->db->select($kolom);
        $this->db->limit(1);
        $this->db->where($this->tableid, $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
    
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if($this->input->post('search')['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $this->input->post('search')['value']);
                }
                else
                {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        } 
        if($this->input->post('order')) 
        {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } 
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($this->input->post('length')?$this->input->post('length'):0 != -1)
        $this->db->limit($this->input->post('length')?$this->input->post('length'):0, $this->input->post('start')?$this->input->post('start'):0);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    function get_combo() {
        $combo=$this->combo;
        $this->db->select($combo[0].','.$combo[1]);
        $this->db->order_by($combo[1]);
        $this->db->from($this->table);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        
        $result = $query->result();
        
        $a_combo=array();
        foreach ($result as $row)
        {
             $a_combo[$row->{$combo[0]}]=$row->{$combo[1]};
        }
        return $a_combo;
    }
}

?>
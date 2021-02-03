<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {

    public $table = 'departments';

    public function __construct() {
        
    }

    public function add($data) {
        $data['created'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $data['modified'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)
                        ->update($this->table, $data);
    }

    public function get_department($id) {
        return $this->db->where('id', $id)
                        ->get($this->table)
                        ->row();
    }     

    public function get_departments() {
        return $this->db->select('departments.*, u1.name as added_name')
                        ->join('users u1', 'u1.id = departments.added_by', 'left')
                        ->get($this->table)
                        ->result();
    }

    public function get_active_departments() {
        return $this->db->where('status', 1)
                        ->get($this->table)
                        ->result(); 
    }

    public function status($id) {
        $data['status'] = $this->get_department($id)->status?0:1;
        $this->update($id, $data);
        return;
    }

    // public function delete_user($id) {
    //     return $this->db->where('id', $id)
    //                     ->delete($this->table);
    // }

}
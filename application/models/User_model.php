<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public $table = 'users';

    public function __construct() {
        
    }

    public function login($user, $password) {
        $exist = $this->db->where('email', $user)
                          ->where('password', md5($password))
                          ->where('status', 1)
                          ->where('work_status', 1)
                          ->get($this->table);
        if ($exist->num_rows()) {
            $data = $exist->row();
                $this->session->set_userdata(['valid_session' => [
                        'user_id' => $data->id,
                        'email' => $data->email,
                        'type' => $data->type,
                        'name' => $data->name,
                        'department' => $data->department
                ]]);
                $this->login_update($data->id);
                return TRUE;
        }
        return FALSE;
    }

    public function login_update($user_id) {
        $data['last_login'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $user_id)
                        ->update($this->table, $data);
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

    public function get_user($id) {
        return $this->db->select('users.*, u1.name as parent_name, departments.name as department_name, departments.input_type')
                        ->where('users.id', $id)
                        ->join('users u1', 'u1.id = users.parent', 'left')
                        ->join('departments', 'departments.id = users.department', 'left')
                        ->get($this->table)
                        ->row();
    }

    public function get_users() {
        return $this->db->select('users.*, u1.name as parent_name, departments.name as department_name')
                        ->where('users.type !=', 1)
                        ->where('users.work_status', 1)
                        ->join('users u1', 'u1.id = users.parent', 'left')
                        ->join('departments', 'departments.id = users.department', 'left')
                        ->get($this->table)
                        ->result();
    }

    public function get_user_by_email($email) {
        return $this->db->where('email', $email)
                        ->get($this->table)
                        ->row();
    }

    public function get_type_users($type = 4) {
        return $this->db->where('type', $type)
                        ->where('work_status', 1)
                        ->get($this->table)
                        ->result();
    }

    public function get_manager_tl() {
        return $this->db->where('type = 2 or type = 3')
                        ->where('work_status', 1)
                        ->get($this->table)
                        ->result();
    }

    public function get_my_users($id) {
        return $this->db->select('users.*, departments.name as department_name')
                        ->where('users.parent', $id)
                        ->where('users.work_status', 1)
                        ->join('departments', 'departments.id = users.department', 'left')
                        ->get($this->table)
                        ->result();
    }

    public function get_depart_user($depart_id) {
        return $this->db->where('department', $depart_id)
                        ->where('status', 1)
                        ->where('work_status', 1)
                        ->get($this->table)
                        ->result();
    }

    public function get_manager_users($manager_id) {
        return $this->db->select('users.*, departments.name as department_name')
                        ->where('((users.parent = '.$manager_id.') or (u1.parent = '.$manager_id.'))')
                        ->where('users.work_status = 1')
                        ->join('users u1', 'users.parent = u1.id', 'left')
                        ->join('departments', 'departments.id = users.department', 'left')
                        ->get($this->table)
                        ->result(); 
    }

    public function status($id) {
        $data['status'] = $this->get_user($id)->status?0:1;
        $this->update($id, $data);
        return;
    }

    // public function delete_user($id) {
    //     return $this->db->where('id', $id)
    //                     ->delete($this->table);
    // }

}
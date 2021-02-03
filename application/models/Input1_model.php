<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Input1_model extends CI_Model {

    public $table = 'input1';

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
                        ->where('status', 1)
                        ->update($this->table, $data);
    }

    public function get_input($id) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as proof_name')
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->where($this->table.'.id', $id)
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->row();
    }

    public function get_inputs($status=1) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as proof_name')
                        ->where($this->table.'.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_my_inputs($agent_id, $status=1) {
        return $this->db->select('input1.*, projects.name as project_name, users.name as proof_name, u2.name as approved_through')
                        ->where('input1.user_id', $agent_id)
                        ->where('input1.status', $status)
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('users', 'users.id=input1.proofread', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_user_inputs($agent_id, $start_date, $close_date, $status=2) {
        return $this->db->select('input1.*, projects.name as project_name, users.name as proof_name, u2.name as approved_through')
                        ->where('(input1.date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($close_date)).'")')
                        ->where('input1.user_id', $agent_id)
                        ->where('input1.status', $status)
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('users', 'users.id=input1.proofread', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_tl_inputs($leader_id, $status=1) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as proof_name')
                        ->where('u1.parent', $leader_id)
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_all_project_inputs($project_id, $start_date, $close_date, $status = 2) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as approved_through, departments.name as department_name, u3.name as proof_name')
                        ->where('(input1.date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($close_date)).'")')
                        ->where('input1.project_id', $project_id)
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('departments', 'departments.id=input1.department_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_leader_all_project_inputs($leader_id, $project_id, $status = 2) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as approved_through, departments.name as department_name, u3.name as proof_name')
                        ->where('u1.parent', $leader_id)
                        ->where('input1.project_id', $project_id)
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('departments', 'departments.id=input1.department_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_manager_inputs($manager_id, $status=1) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u3.name as proof_name')
                        ->where('(u2.parent = '.$manager_id.' or u1.parent = '.$manager_id.')')
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=u1.parent', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_manager_all_project_inputs($manager_id, $project_id, $status = 2) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as approved_through, departments.name as department_name, u3.name as proof_name')
                        ->where('u.parent', $manager_id)
                        ->where('input1.project_id', $project_id)
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u', 'u.id=u1.parent', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('departments', 'departments.id=input1.department_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_my_work_project($agent_id, $status = 2) {
        return $this->db->select('input1.*, projects.name as project_name')
                        ->where('input1.user_id', $agent_id)
                        ->where('input1.status', $status)
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->group_by('input1.project_id')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    public function get_my_project_work($agent_id, $project_id, $status = 2) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as approved_through, u3.name as proof_name')
                        ->where('input1.user_id', $agent_id)
                        ->where('input1.project_id', $project_id)
                        ->where('input1.status', $status)
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function project_work_type2($project_id, $activity, $start_date, $close_date, $status = 2) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as approved_through, departments.name as department_name, u3.name as proof_name')
                        ->where('(input1.date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($close_date)).'")')
                        ->where('input1.project_id', $project_id)
                        ->where('input1.activity', $activity)
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('departments', 'departments.id=input1.department_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function get_department_work($department_id, $start_date, $close_date, $status=2) {
        return $this->db->select('input1.*, projects.name as project_name, u1.name as agent_name, u2.name as approved_through, departments.name as department_name, u3.name as proof_name')
                        ->where('(input1.date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($close_date)).'")')
                        ->where('u1.department', $department_id)
                        ->where('input1.status', $status)
                        ->join('users u1', 'u1.id=input1.user_id', 'left')
                        ->join('users u2', 'u2.id=input1.approved_by', 'left')
                        ->join('users u3', 'u3.id=input1.proofread', 'left')
                        ->join('projects', 'projects.id=input1.project_id', 'left')
                        ->join('departments', 'departments.id=input1.department_id', 'left')
                        ->order_by('input1.date', 'desc')
                        ->get($this->table)
                        ->result();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete_input($id) {
        return $this->db->where('id', $id)
                        ->where('status', 1)
                        ->delete($this->table);
    }

}
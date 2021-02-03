<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    public $table = 'projects';

    public function __construct() {
        
    }

    public function add($data) {
        $data['created'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        $department = $this->db->where('id', $data['departments'])
                                ->get('departments')
                                ->row();
        $departments = $this->db->where('departments', $data['departments'])
                                ->get($this->table)
                                ->result();
        $num = sizeof($departments);
        $project_id = (get_initial($department->name)) . str_pad($num, 5, "0", STR_PAD_LEFT);
        $this->db->where('id', $id)
                 ->update($this->table, ['project_id' => $project_id]);
        return $id;
    }

    public function chk_exist($depart_id, $name) {
        return $this->db->where('departments', $depart_id)
                        ->where('name', $name)
                        ->get($this->table)
                        ->num_rows();
    }

    public function update($id, $data) {
        $data['modified'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)
                        ->update($this->table, $data);
    }

    public function get_project($id) {
        return $this->db->select('projects.*, u1.name as added_name')
                        ->where('projects.id', $id)
                        ->join('users u1', 'u1.id = projects.added_by', 'left')
                        ->get($this->table)
                        ->row();
    }

    public function get_type_projects($status = 1) {
        return $this->db->select('projects.*, u1.name as added_name')
                        ->where('projects.status', $status)
                        ->join('users u1', 'u1.id = projects.added_by', 'left')
                        ->order_by('projects.id', 'DESC')
                        ->get($this->table)
                        ->result();
    }    

    public function get_unclosed_projects(){
        return $this->db->select('projects.*, u1.name as added_name')
                        ->where('projects.status = 1 or projects.status = 0')
                        ->join('users u1', 'u1.id = projects.added_by', 'left')
                        ->order_by('projects.id', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function get_projects() {
        return $this->db->select('projects.*, u1.name as added_name')
                        ->join('users u1', 'u1.id = projects.added_by', 'left')
                        ->order_by('projects.id', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function status($id) {
        $data['status'] = $this->get_project($id)->status?0:1;
        $this->update($id, $data);
        return;
    }

    public function active_department_project($depart_id, $status=1) {
        return $this->db->where('departments', $depart_id)
                        ->where('status', $status)
                        ->order_by('projects.id', 'DESC')
                        ->get($this->table)
                        ->result();

        // return $this->db->where('JSON_EXTRACT(departments, "$.'.$depart_id.'") = '.$depart_id.'')
        //                 ->where('status', $status)
        //                 ->get($this->table)
        //                 ->result();
        //////////////////////////////////////////////////////////////////////////////////////////////
        // $projects = $this->db->where('status', $status)
        //                      ->get($this->table)
        //                      ->result();
        // $data = array();
        // foreach ($projects as $project) {
        //     foreach (json_decode($project->departments) as $department) {
        //         if($department == $depart_id){
        //             $data[] = $project;
        //         }
        //     }
        // }
        // return $data;
    }

}
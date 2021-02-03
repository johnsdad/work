<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewer_library {

    protected $ci;

    function __construct() {
        $this->ci = & get_instance();
    }

    public function get_user_name($user_id) {
        $this->ci->load->model('user_model', 'user');
        $data = $this->ci->user->get_user($user_id)->name;
        return $data;
    }

    public function get_department($id) {
        $this->ci->load->model('department_model', 'department');
        $data = $this->ci->department->get_department($id)->name;
        return $data;
    }
}

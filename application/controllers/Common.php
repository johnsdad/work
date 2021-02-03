<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('valid_session')) {
            $this->session->set_userdata('after_login', $_SERVER['REQUEST_URI']);
            $this->session->set_flashdata('error', 'Unauthorized Access');
            redirect('login');
        }        
        $this->load->model('user_model', 'user');
        $this->load->model('department_model', 'department');
        $this->load->model('project_model', 'project');
        $this->load->model('input1_model', 'input1');
	}

    public function user_work_details($user_id) {
        $data['inputs'] = $this->input1->get_my_inputs($user_id, 2);
        $data['startdate'] = 0;
        $data['enddate'] = 0;
        $data['user_id'] = $user_id;
        $this->load->view('common/user_work_details', $data);
    }

    public function user_work_range_details($user_id, $start_date, $end_date) {
        if(strtotime($start_date) > strtotime($end_date)) {
            echo '<center class="h3 text-danger">Select a valid date Range.</center>';
            exit;
        }
        $data['inputs'] = $this->input1->get_user_inputs($user_id, $start_date, $end_date);
        $data['startdate'] = $start_date;
        $data['enddate'] = $end_date;
        $data['user_id'] = $user_id;
        $this->load->view('common/user_work_details', $data);
    }

    public function show_links($input_id) {
        $data['input'] = $this->input1->get_input($input_id);
        $this->load->view('common/link_view', $data);
    }

    public function show_content($input_id) {
        $data['input'] = $this->input1->get_input($input_id);
        $this->load->view('common/content_view', $data);
    }

    public function project_works($project_id) {
        $data['project'] = $this->project->get_project($project_id);
        $data['startdate'] = date('Y-m-d', strtotime($data['project']->created));
        $data['enddate'] = date('Y-m-d');
        $data['works'] = $this->input1->get_all_project_inputs($project_id, $data['startdate'], $data['enddate']);
        $this->load->view('common/work_details', $data);
    }

    public function project_work_range($project_id, $startdate, $enddate) {
        $data['project'] = $this->project->get_project($project_id);
        $data['startdate'] = $startdate;
        $data['enddate'] = $enddate;
        $data['works'] = $this->input1->get_all_project_inputs($project_id, $data['startdate'], $data['enddate']);
        $this->load->view('common/work_details_range', $data);
    }

    //////////////////////////////////////////////  filter  ////////////////////////////////////////////////

    public function project_work_type2() {
        if(isset($_POST['activity']) && isset($_POST['project_id']) && isset($_POST['startdate']) && isset($_POST['enddate'])) {
            $start_date = $this->input->post('startdate');
            $end_date = $this->input->post('enddate');
            if($_POST['activity'] == '') {
                $data['works'] = $this->input1->get_all_project_inputs($this->input->post('project_id'), $start_date, $end_date);
            } else {
                $data['works'] = $this->input1->project_work_type2($this->input->post('project_id'), $this->input->post('activity'), $start_date, $end_date);
            }
        }
        $this->load->view('common/project_work_type2', $data);
    }

    public function project_work_type3() {
        if(isset($_POST['activity']) && isset($_POST['project_id']) && isset($_POST['startdate']) && isset($_POST['enddate'])) {
            $start_date = $this->input->post('startdate');
            $end_date = $this->input->post('enddate');
            $data['activity'] = $this->input->post('activity');
            $data['works'] = $this->input1->get_all_project_inputs($this->input->post('project_id'), $start_date, $end_date);
        }
        $this->load->view('common/project_work_type3', $data);
    }

    public function user_work_type2() {
        if(isset($_POST['activity']) && isset($_POST['user_id']) && isset($_POST['startdate']) && isset($_POST['enddate'])) {
            $start_date = $this->input->post('startdate');
            $end_date = $this->input->post('enddate');
            if($_POST['startdate'] == 0 && $_POST['enddate'] == 0){
                $data['inputs'] = $this->input1->get_my_inputs($this->input->post('user_id'), 2);
            } else {
                $data['inputs'] = $this->input1->get_user_inputs($this->input->post('user_id'), $start_date, $end_date);
            }
            $data['activity'] = $this->input->post('activity');
            $this->load->view('common/user_work_type2', $data);
        }
    }

    public function user_work_type3() {
        if(isset($_POST['activity']) && isset($_POST['user_id']) && isset($_POST['startdate']) && isset($_POST['enddate'])) {
            $start_date = $this->input->post('startdate');
            $end_date = $this->input->post('enddate');
            if($_POST['startdate'] == 0 && $_POST['enddate'] == 0){
                $data['inputs'] = $this->input1->get_my_inputs($this->input->post('user_id'), 2);
            } else {
                $data['inputs'] = $this->input1->get_user_inputs($this->input->post('user_id'), $start_date, $end_date);
            }
            $data['activity'] = $this->input->post('activity');
            $this->load->view('common/user_work_type3', $data);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    public function department_works($department_id) {
        $start_date = date('d-m-Y');
        $end_date = date('d-m-Y');
        if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            if(strtotime($start_date) > strtotime($end_date)) {
                echo '<center class="h3 text-danger">Select a valid date Range.</center>';
                exit;
            }
        }
        $data['inputs'] = $this->input1->get_department_work($department_id, $start_date, $end_date);
        $this->load->view('common/department_works', $data);
    }


}

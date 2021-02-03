<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('valid_session') || $this->session->userdata('valid_session')['type'] != 4) {
            $this->session->set_userdata('after_login', $_SERVER['REQUEST_URI']);
            $this->session->set_flashdata('error', 'Unauthorized Access');
            redirect('login');
        }        
        $this->load->model('input1_model', 'input1');
        $this->load->model('department_model', 'department');
        $this->load->model('project_model', 'project');
	}

    public function index() {
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);
        $this->load->view('agent/index', $data);
    }

    public function update_password() {
        $this->load->model('user_model', 'user');
        $this->load->library('form_validation');
        if($this->input->post('addForm')) {
            if($this->user->get_user($this->session->userdata('valid_session')['user_id'])->password == md5($this->input->post('old_password'))) {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]|min_length[6]');
                if($this->form_validation->run()) {
                    $data['password'] = md5($this->input->post('password'));
                    if($this->user->update($this->session->userdata('valid_session')['user_id'], $data)) {
                        $this->session->set_flashdata('success', 'Password Update Successfully.');
                        redirect('agent');
                    }
                    $this->session->set_flashdata('error', 'Something Went Wrong.');
                    redirect('agent');
                }
                $this->session->set_flashdata('error', validation_errors());
                redirect('agent');
            }
            $this->session->set_flashdata('error', 'Current Password not matched');
            redirect('agent');
        }
    }

///////////////////////////////////////////////////////////////////////////////////

    public function projects() {
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);
        $this->load->view('agent/projects', $data);
    }


///////////////////////////////////////////////////////////////////////////////////

    public function report() {
        $department = $this->department->get_department($this->session->userdata('valid_session')['department']);        
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);

        if($department->input_type == 1) {
            $data['inputs'] = $this->input1->get_my_inputs($this->session->userdata('valid_session')['user_id']);
            $this->load->view('agent/report1', $data);

        } else if($department->input_type == 2) {
            $data['inputs'] = $this->input1->get_my_inputs($this->session->userdata('valid_session')['user_id']);
            $this->load->view('agent/report2', $data);

        } else if($department->input_type == 3) {
            $data['inputs'] = $this->input1->get_my_inputs($this->session->userdata('valid_session')['user_id']);
            $this->load->view('agent/report3', $data);

        } else {
            $data['inputs'] = '';
            $this->load->view('agent/report1', $data);
        }
    }

    public function get_input_form() {
        if($this->input->post('project_id')) {
            $department = $this->department->get_department($this->session->userdata('valid_session')['department']);
            $data['project_id'] = $this->input->post('project_id');

            if($department->input_type == 1) {
                $this->load->view('agent/forms/input1', $data);
            } else if($department->input_type == 2) {
                $this->load->view('agent/forms/input2', $data);
            } else if($department->input_type == 3) {
                $this->load->model('user_model', 'user');
                $data['users'] = $this->user->get_depart_user($this->session->userdata('valid_session')['department']);
                $this->load->view('agent/forms/input3', $data);
            } else {
                echo '<center class="text text-danger h2 m-5">Undefind Input Type</center>';
            }
        }
    }

    public function save_input1() {
        if($this->input->post('input1')){
            if(isset($_POST['id'])) {
                $data = $this->input->post('data');
                if($this->input1->update($this->input->post('id'), $data)) {
                    $this->session->set_flashdata('success', 'Updated Successfully.');
                    redirect('agent/report');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('agent/report');
                exit;
            }

            if(strtotime($this->input->post('date')) < strtotime('-7 days') || strtotime($this->input->post('date')) > strtotime(date('Y-m-d'))) {
                $this->session->set_flashdata('warning', 'Enter an valid work date.');
                redirect('agent/report');
                exit;
            }
            $data['activity'] = $this->input->post('activity');
            $data['minutes'] = $this->input->post('minutes');
            $data['hours'] = $this->input->post('hours');
            $data['project_id'] = $this->input->post('project_id');
            $data['department_id'] = $this->session->userdata('valid_session')['department'];
            $data['input_type'] = $this->input->post('input_type');
            $data['date'] = $this->input->post('date');
            $data['user_id'] = $this->session->userdata('valid_session')['user_id'];

            if($this->input1->add($data)) {
                $this->session->set_flashdata('success', 'Add Successfully.');
                redirect('agent/report');
            }
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect('agent/report');
        }
        $this->session->set_flashdata('warning', 'Wrong way!');
        redirect('agent/report');
    }

    public function save_input2() {
        if($this->input->post('input2')){
            if(isset($_POST['id'])) {
                $data = $this->input->post('data');
                if($this->input1->update($this->input->post('id'), $data)) {
                    $this->session->set_flashdata('success', 'Updated Successfully.');
                    redirect('agent/report');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('agent/report');
                exit;
            }

            if(strtotime($this->input->post('date')) < strtotime('-7 days') || strtotime($this->input->post('date')) > strtotime(date('Y-m-d'))) {
                $this->session->set_flashdata('warning', 'Enter an valid work date.');
                redirect('agent/report');
                exit;
            }
            $data['activity'] = $this->input->post('activity');
            $data['numbers'] = $this->input->post('numbers');
            $data['project_id'] = $this->input->post('project_id');
            $data['department_id'] = $this->session->userdata('valid_session')['department'];
            $data['input_type'] = $this->input->post('input_type');
            $data['date'] = $this->input->post('date');
            $data['links'] = $this->input->post('links');
            $data['user_id'] = $this->session->userdata('valid_session')['user_id'];

            if($this->input1->add($data)) {
                $this->session->set_flashdata('success', 'Add Successfully.');
                redirect('agent/report');
            }
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect('agent/report');
        }
        $this->session->set_flashdata('warning', 'Wrong way!');
        redirect('agent/report');
    }

    public function save_input3() {
        if($this->input->post('input3')){
            if(isset($_POST['id'])) {
                $data = $this->input->post('data');
                if($this->input1->update($this->input->post('id'), $data)) {
                    $this->session->set_flashdata('success', 'Updated Successfully.');
                    redirect('agent/report');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('agent/report');
                exit;
            }

            if(strtotime($this->input->post('date')) < strtotime('-7 days') || strtotime($this->input->post('date')) > strtotime(date('Y-m-d'))) {
                $this->session->set_flashdata('warning', 'Enter an valid work date.');
                redirect('agent/report');
                exit;
            }
            $data['activity'] = $this->input->post('activity');
            if(isset($_POST['numbers'])) {
                $data['numbers'] = $this->input->post('numbers');
            }
            if(isset($_POST['content'])) {
                $data['content'] = $this->input->post('content');
            }
            $data['project_id'] = $this->input->post('project_id');
            $data['department_id'] = $this->session->userdata('valid_session')['department'];
            $data['input_type'] = $this->input->post('input_type');
            $data['date'] = $this->input->post('date');
            $data['proofread'] = $this->input->post('proofread');
            $data['user_id'] = $this->session->userdata('valid_session')['user_id'];

            if($this->input1->add($data)) {
                $this->session->set_flashdata('success', 'Add Successfully.');
                redirect('agent/report');
            }
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect('agent/report');
        }
        $this->session->set_flashdata('warning', 'Wrong way!');
        redirect('agent/report');
    }

    public function get_edit_input_form($input_id) {
        $data['input'] = $this->input1->get_input($input_id);
        if($data['input']->status == 0 || $data['input']->status == 2) {
             echo '<center class="text text-danger h2 m-5">Not Permitted.</center>';
             exit;
        }

        if($data['input']->input_type == 1) {
            $this->load->view('agent/forms/edit_input1', $data);
        } else if($data['input']->input_type == 2) {
            $this->load->view('agent/forms/edit_input2', $data);
        } else if($data['input']->input_type == 3) {
            $this->load->view('agent/forms/edit_input3', $data);
        } else {
            echo '<center class="text text-danger h2 m-5">Undefind Input Type</center>';
        }
    }

    public function delete_input($input_id) {
        $data['input'] = $this->input1->get_input($input_id);
        if($data['input']->status == 0 || $data['input']->status == 2) {
             return false;
             exit;
        }
        $this->input1->delete_input($input_id);
        $this->report();
    }

    public function project_work() {
        $data['inputs'] = $this->input1->get_my_work_project($this->session->userdata('valid_session')['user_id']);
        //echo '<pre>'; print_r($data);
        $this->load->view('agent/project_work', $data);
    }

    public function project_works($project_id) {
        $data['project'] = $this->project->get_project($project_id);
        $data['works'] = $this->input1->get_my_project_work($this->session->userdata('valid_session')['user_id'], $project_id);
        $this->load->view('common/work_details', $data);
    }

    public function show_links($input_id) {
        $data['input'] = $this->input1->get_input($input_id);
        $this->load->view('common/link_view', $data);
    }

    public function date_wise_work() {
        if(isset($_POST['from_date']) && isset($_POST['to_date'])){
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            if((strtotime($from_date) > strtotime($to_date)) ||  (strtotime($from_date) > strtotime(date('d-m-Y')))) {
                echo '<center class="h3 text-danger">Select a valid date Range.</center>';
                exit;
            }
            $data['works'] = $this->input1->get_user_inputs($this->session->userdata('valid_session')['user_id'], $from_date, $to_date);
            $this->load->view('agent/ajax/user_works', $data);
        } else {
            $from_date = date('d-m-Y');
            $to_date = date('d-m-Y');
            $data['works'] = $this->input1->get_user_inputs($this->session->userdata('valid_session')['user_id'], $from_date, $to_date);
            $this->load->view('agent/date_wise_work', $data);
        }
    }

    public function my_project_work($project_id) {
        $data['project_id'] = $project_id;
        $this->load->view('agent/my_project_work', $data);
    }

}

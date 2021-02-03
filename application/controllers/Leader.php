<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leader extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('valid_session') || $this->session->userdata('valid_session')['type'] != 3) {
            $this->session->set_userdata('after_login', $_SERVER['REQUEST_URI']);
            $this->session->set_flashdata('error', 'Unauthorized Access');
            redirect('login');
        }        
        $this->load->model('user_model', 'user');
        $this->load->model('department_model', 'department');
        $this->load->model('project_model', 'project');
        $this->load->model('input1_model', 'input1');
	}

    public function index() {
        $data['users'] = $this->user->get_my_users($this->session->userdata('valid_session')['user_id']);

        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);        
        if($this->session->userdata('valid_session')['type'] == 3 && $this->session->userdata('valid_session')['department'] == 2) {
            $projects = $this->project->active_department_project(3);
            $data['projects'] = array_merge($data['projects'], $projects);
        }

        $data['requests'] = $this->input1->get_tl_inputs($this->session->userdata('valid_session')['user_id']);
        $data['closed_projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department'], 2);
        if($this->session->userdata('valid_session')['type'] == 3 && $this->session->userdata('valid_session')['department'] == 2) {
            $projects2 = $this->project->active_department_project(3, 2);
            $data['closed_projects'] = array_merge($data['closed_projects'], $projects2);
        }
        $this->load->view('leader/index', $data);
    } 

    public function update_password() {
        $this->load->library('form_validation');
        if($this->input->post('addForm')) {
            if($this->user->get_user($this->session->userdata('valid_session')['user_id'])->password == md5($this->input->post('old_password'))) {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]|min_length[6]');
                if($this->form_validation->run()) {
                    $data['password'] = md5($this->input->post('password'));
                    if($this->user->update($this->session->userdata('valid_session')['user_id'], $data)) {
                        $this->session->set_flashdata('success', 'Password Update Successfully.');
                        redirect('leader');
                    }
                    $this->session->set_flashdata('error', 'Something Went Wrong.');
                    redirect('leader');
                }
                $this->session->set_flashdata('error', validation_errors());
                redirect('leader');
            }
            $this->session->set_flashdata('error', 'Current Password not matched');
            redirect('leader');
        }
    }

//////////////////////////////////////////////////////////////////////////////

    public function agents(){
        $data['users'] = $this->user->get_my_users($this->session->userdata('valid_session')['user_id']);
        $this->load->view('leader/agents',$data);
    } 

    public function show_user($id) {
        $data['user'] = $this->user->get_user($id);
        $this->load->view('leader/ajax/user_details', $data);
    }

    public function user_status($id) {
        $this->user->status($id);
        $user = $this->user->get_user($id);
        echo $user->status?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-warning"> Inactive </span>';
    }

///////////////////////////////////////////////////////////////////////////////
    public function projects(){
        $this->load->library('form_validation');
        if($this->input->post('addProject')) {
            $this->form_validation->set_rules('project', 'Name', 'required');
            if ($this->form_validation->run()) {
                $data['name'] = $this->input->post('project');
                $data['estimate'] = $this->input->post('estimate');
                if(isset($_POST['departments'])) {
                    $data['departments'] = $this->input->post('departments');
                } else {
                    $data['departments'] = $this->session->userdata('valid_session')['department'];                    
                }
                $data['added_by'] = $this->session->userdata('valid_session')['user_id'];
                if(isset($_POST['id'])) {
                    if($this->project->update($this->input->post('id'), $data)) {
                        $this->session->set_flashdata('success', 'Project Updated Successfully.');
                        redirect('leader/projects');
                    }    
                } else {
                    if($this->project->chk_exist($data['departments'], $data['name'])){
                        $this->session->set_flashdata('warning', 'Project name aalready exist in same department.');
                        redirect('leader/projects');
                        exit;
                    }
                    if($this->project->add($data)) {
                        $this->session->set_flashdata('success', 'Project Added Successfully.');
                        redirect('leader/projects');
                    }                    
                }
                $this->session->set_flashdata('error', 'Something Went Wrong.');
                redirect('leader/projects');
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('leader/projects');
        }
        $data['departments'] = $this->department->get_active_departments();
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);
        
        if($this->session->userdata('valid_session')['type'] == 3 && $this->session->userdata('valid_session')['department'] == 2) {
            $projects = $this->project->active_department_project(3);
            $data['projects'] = array_merge($data['projects'], $projects);
        }
        $this->load->view('leader/projects', $data);
    }

    public function edit_project($id) {
        $data['project'] = $this->project->get_project($id);
        $this->load->view('leader/ajax/edit_project', $data);
    }

    public function closed_projects() {
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department'], 2);
        if($this->session->userdata('valid_session')['type'] == 3 && $this->session->userdata('valid_session')['department'] == 2) {
            $projects = $this->project->active_department_project(3, 2);
            $data['projects'] = array_merge($data['projects'], $projects);
        }
        $this->load->view('leader/closed_projects', $data);
    }

    public function show_project($id) {
        $data['project'] = $this->project->get_project($id);
        $this->load->view('leader/ajax/show_project', $data);        
    }
//////////////////////////////////////////////////////////////////////////////

    public function input_request(){
        $data['inputs'] = $this->input1->get_tl_inputs($this->session->userdata('valid_session')['user_id']);    
        $this->load->view('leader/input_request', $data);
    }

    public function view_input($id) {
        $data['input'] = $this->input1->get_input($id);
        if($data['input']->input_type == 1) {
            $this->load->view('common/view_input1', $data);
        } else if($data['input']->input_type == 2) {
            $this->load->view('common/view_input2', $data);
        } else if($data['input']->input_type == 3) {
            $this->load->view('common/view_input3', $data);
        } else {
            echo 'Invaid Format.';
        }
    }

    public function edit_input($id){
        $data['input'] = $this->input1->get_input($id);
        if($data['input']->status==0 || $data['input']->status==2){
            echo "Already Actioned!";
            exit;
        }

        if($data['input']->input_type == 1) {
            $this->load->view('common/edit_input1', $data);
        } else if($data['input']->input_type == 2) {
            $this->load->view('common/edit_input2', $data);
        } else if($data['input']->input_type == 3) {
            $this->load->view('common/edit_input3', $data);
        } else {
            echo 'Invaid Format.';
        }
    }

    public function update_input(){
        if($this->input->post('input')){
            if(isset($_POST['id'])) {
                $data = $this->input->post('data');
                if($this->input1->update($this->input->post('id'), $data)) {
                    $this->session->set_flashdata('success', 'Updated Successfully.');
                    redirect('leader/input_request');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('leader/input_request');
                exit;
            }
        }
    }

    public function input_action($input_id, $action) {
        $user = $this->session->userdata('valid_session')['user_id'];
        if($action==0 || $action==2) {
            $this->input1->update($input_id, ['approved_by' => $user, 'status' => $action]);
        }
        $this->input_request();
    } 

    public function project_work() {
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);
        if($this->session->userdata('valid_session')['type'] == 3 && $this->session->userdata('valid_session')['department'] == 2) {
            $projects = $this->project->active_department_project(3);
            $data['projects'] = array_merge($data['projects'], $projects);
        }
        $this->load->view('leader/project_work', $data);
    }

    public function closed_project_work() {
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department'], 2);
        $this->load->view('leader/closed_project_work', $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function report() {
        $department = $this->department->get_department($this->session->userdata('valid_session')['department']);        
        $data['projects'] = $this->project->active_department_project($this->session->userdata('valid_session')['department']);

        if($department->input_type == 1) {
            $data['inputs'] = $this->input1->get_my_inputs($this->session->userdata('valid_session')['user_id']);
            $this->load->view('leader/report1', $data);

        } else if($department->input_type == 2) {
            $data['inputs'] = $this->input1->get_my_inputs($this->session->userdata('valid_session')['user_id']);
            $this->load->view('leader/report1', $data);

        } else if($department->input_type == 3) {
            $data['inputs'] = $this->input1->get_my_inputs($this->session->userdata('valid_session')['user_id']);
            $this->load->view('leader/report3', $data);

        } else {
            $data['inputs'] = '';
            $this->load->view('leader/report1', $data);
        }
    }

    public function get_input_form() {
        if($this->input->post('project_id')) {
            $department = $this->department->get_department($this->session->userdata('valid_session')['department']);
            $data['project_id'] = $this->input->post('project_id');

            if($department->input_type == 1) {
                $this->load->view('leader/forms/input1', $data);
            } else if($department->input_type == 2) {
                $this->load->view('leader/forms/input1', $data);
            } else if($department->input_type == 3) {
                $this->load->model('user_model', 'user');
                $data['users'] = $this->user->get_depart_user($this->session->userdata('valid_session')['department']);
                $this->load->view('leader/forms/input3', $data);
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
                    redirect('leader/report');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('leader/report');
                exit;
            }

            if(strtotime($this->input->post('date')) < strtotime('-7 days') || strtotime($this->input->post('date')) > strtotime(date('Y-m-d'))) {
                $this->session->set_flashdata('warning', 'Enter an valid work date.');
                redirect('leader/report');
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
                redirect('leader/report');
            }
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect('leader/report');
        }
        $this->session->set_flashdata('warning', 'Wrong way!');
        redirect('leader/report');
    }

    public function save_input2() {
        if($this->input->post('input2')){
            if(isset($_POST['id'])) {
                $data = $this->input->post('data');
                if($this->input1->update($this->input->post('id'), $data)) {
                    $this->session->set_flashdata('success', 'Updated Successfully.');
                    redirect('leader/report');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('leader/report');
                exit;
            }

            if(strtotime($this->input->post('date')) < strtotime('-7 days') || strtotime($this->input->post('date')) > strtotime(date('Y-m-d'))) {
                $this->session->set_flashdata('warning', 'Enter an valid work date.');
                redirect('leader/report');
                exit;
            }
            $data['activity'] = $this->input->post('activity');
            if(isset($_POST['numbers'])) {
                $data['numbers'] = $this->input->post('numbers');
            }
            $data['project_id'] = $this->input->post('project_id');
            $data['department_id'] = $this->session->userdata('valid_session')['department'];
            $data['input_type'] = $this->input->post('input_type');
            $data['date'] = $this->input->post('date');
            $data['links'] = $this->input->post('links');
            $data['user_id'] = $this->session->userdata('valid_session')['user_id'];

            if($this->input1->add($data)) {
                $this->session->set_flashdata('success', 'Add Successfully.');
                redirect('leader/report');
            }
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect('leader/report');
        }
        $this->session->set_flashdata('warning', 'Wrong way!');
        redirect('leader/report');
    }

    public function save_input3() {
        if($this->input->post('input3')){
            if(isset($_POST['id'])) {
                $data = $this->input->post('data');
                if($this->input1->update($this->input->post('id'), $data)) {
                    $this->session->set_flashdata('success', 'Updated Successfully.');
                    redirect('leader/report');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('leader/report');
                exit;
            }

            if(strtotime($this->input->post('date')) < strtotime('-7 days') || strtotime($this->input->post('date')) > strtotime(date('Y-m-d'))) {
                $this->session->set_flashdata('warning', 'Enter an valid work date.');
                redirect('leader/report');
                exit;
            }
            $data['activity'] = $this->input->post('activity');
            $data['numbers'] = $this->input->post('numbers');
            $data['project_id'] = $this->input->post('project_id');
            $data['department_id'] = $this->session->userdata('valid_session')['department'];
            $data['input_type'] = $this->input->post('input_type');
            $data['date'] = $this->input->post('date');
            $data['proofread'] = $this->input->post('proofread');
            $data['user_id'] = $this->session->userdata('valid_session')['user_id'];

            if($this->input1->add($data)) {
                $this->session->set_flashdata('success', 'Add Successfully.');
                redirect('leader/report');
            }
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect('leader/report');
        }
        $this->session->set_flashdata('warning', 'Wrong way!');
        redirect('leader/report');
    }

    public function get_edit_input_form($input_id) {
        $data['input'] = $this->input1->get_input($input_id);
        if($data['input']->status == 0 || $data['input']->status == 2) {
             echo '<center class="text text-danger h2 m-5">Not Permitted.</center>';
             exit;
        }

        if($data['input']->input_type == 1) {
            $this->load->view('leader/forms/edit_input1', $data);
        } else if($data['input']->input_type == 2) {
            $this->load->view('leader/forms/edit_input2', $data);
        } else if($data['input']->input_type == 3) {
            $this->load->view('leader/forms/edit_input3', $data);
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

    /////////////////////////////////////////////////////////////////////////////////////////

    public function project_details($project_id) {
        $data['project_id'] = $project_id;
        $this->load->view('leader/project_details', $data);
    }

    public function user_work($user_id) {
        $data['user'] = $this->user->get_user($user_id);
        $data['user_id'] = $user_id;
        $this->load->view('leader/user_work', $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    public function department_work() {
        $data['departments'] = $this->department->get_active_departments();
        $this->load->view('leader/department_work', $data);
    }

    public function department_works($department_id) {
        $data['department'] = $this->department->get_department($department_id);
        $this->load->view('leader/department_works', $data);
    }
}

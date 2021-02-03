<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('valid_session') || $this->session->userdata('valid_session')['type'] != 1) {
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
        $data['users'] = $this->user->get_users();
        $data['projects'] = $this->project->get_unclosed_projects();
        $data['requests'] = $this->input1->get_inputs();
        $data['closed_projects'] = $this->project->get_type_projects(2);
        $this->load->view('admin/index', $data);
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
                        redirect('admin');
                    }
                    $this->session->set_flashdata('error', 'Something Went Wrong.');
                    redirect('admin');
                }
                $this->session->set_flashdata('error', validation_errors());
                redirect('admin');
            }
            $this->session->set_flashdata('error', 'Current Password not matched');
            redirect('admin');
        }
    }

    ////////////////////////////////////////////////// User //////////////////////////////////////////////////////

	public function users() {
		$this->load->library('form_validation');
		if($this->input->post('addUser')) {
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('type', 'User Type', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Password Confirmation', 'required|matches[password]|min_length[6]');

            if(isset($_POST['parent'])){
                $this->form_validation->set_rules('parent', 'Super Member', 'required|integer');
            }
            if(isset($_POST['department'])){
                $this->form_validation->set_rules('department', 'Department', 'required|integer');
            }
            if($this->form_validation->run()) {
            	$data['user_id'] = $this->input->post('user_id');
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['password'] = md5($this->input->post('password'));
                $data['type'] = $this->input->post('type');
                $data['parent'] = $this->input->post('parent')?$this->input->post('parent'):$this->session->userdata('valid_session')['user_id'];
                $data['department'] = $this->input->post('department')?$this->input->post('department'):0;
                if($this->user->add($data)) {
                    $this->session->set_flashdata('success', 'User Added Successfully.');
                    redirect('admin/users');
                }
                $this->session->set_flashdata('error', 'Something Went Wrong.');
                redirect('admin/add_user');
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/add_user');
		}
        $data['users'] = $this->user->get_users();
		$this->load->view('admin/users', $data);
	}

    public function update_user() {
        $this->load->library('form_validation');
        if($this->input->post('updateUser')) {
            $this->form_validation->set_rules('id', 'Valid ID', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            if($this->form_validation->run()) {
                $data['user_id'] = $this->input->post('user_id');
                $data['name'] = $this->input->post('name');
                $id = $this->input->post('id');
                if($this->user->update($id, $data)) {
                    $this->session->set_flashdata('success', 'User Update Successfully.');
                    redirect('admin/users');
                }
                $this->session->set_flashdata('error', 'Something Went Wrong.');
                redirect('admin/users');
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/users');
        }
        redirect('admin/users');
    }

    public function add_user() {
        $this->load->view('admin/add_user');
    }

    public function edit_user($id) {
        $data['user'] = $this->user->get_user($id);
        $this->load->view('admin/edit_user', $data);
    }
    public function show_user($id) {
        $data['user'] = $this->user->get_user($id);
        $this->load->view('admin/ajax/user_details', $data);
    }

    public function add_user_fields() {
        if(isset($_POST['type'])) {
            $data['departments'] = $this->department->get_departments();
            if($this->input->post('type') == 3) {
                $data['parents'] = $this->user->get_type_users(2);
            } else if($this->input->post('type') == 4) {
                $data['parents'] = $this->user->get_manager_tl();
            }
            $this->load->view('admin/ajax/user_fields', $data);
        }
    }

	public function user_status($id) {
        $this->user->status($id);
        $user = $this->user->get_user($id);
        echo $user->status?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-warning"> Inactive </span>';
    }

    public function disable_user($user_id) {
        $this->user->update($user_id, ['status' => 0, 'work_status' => 0]);
        $this->users();
    }

    //////////////////////////////////////////////// Department ////////////////////////////////////////////////////

    public function departments() {
        $this->load->library('form_validation');
        if($this->input->post('addDepartment')) {
            $this->form_validation->set_rules('department', 'Name', 'required');
            $this->form_validation->set_rules('type', 'Input Type', 'required');
            if ($this->form_validation->run()) {
                $data['name'] = $this->input->post('department');
                $data['input_type'] = $this->input->post('type');
                $data['added_by'] = $this->session->userdata('valid_session')['user_id'];
                if(isset($_POST['id'])) {
                    if($this->department->update($this->input->post('id'), $data)) {
                        $this->session->set_flashdata('success', 'Department Updated Successfully.');
                        redirect('admin/departments');
                    }    
                } else {
                    if($this->department->add($data)) {
                        $this->session->set_flashdata('success', 'Department Added Successfully.');
                        redirect('admin/departments');
                    }                    
                }
                $this->session->set_flashdata('error', 'Something Went Wrong.');
                redirect('admin/departments');
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/departments');
        }
        $data['departments'] = $this->department->get_departments();
        $this->load->view('admin/departments', $data);
    }

    public function edit_department($id) {
        $data['department'] = $this->department->get_department($id);
        $this->load->view('admin/ajax/edit_department', $data);
    }

    public function department_status($id) {
        $this->department->status($id);
        $department = $this->department->get_department($id);
        echo $department->status?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-warning"> Inactive </span>';
    }

    /////////////////////////////////////////////////// Projects ///////////////////////////////////////////////

    public function projects() {
        $this->load->library('form_validation');
        if($this->input->post('addProject')) {
            $this->form_validation->set_rules('project', 'Name', 'required');
            if ($this->form_validation->run()) {
                $data['name'] = $this->input->post('project');
                $data['estimate'] = $this->input->post('estimate');
                $data['departments'] = $this->input->post('departments');
                $data['added_by'] = $this->session->userdata('valid_session')['user_id'];
                if(isset($_POST['id'])) {
                    if($this->project->update($this->input->post('id'), $data)) {
                        $this->session->set_flashdata('success', 'Project Updated Successfully.');
                        redirect('admin/projects');
                    }    
                } else {
                    if($this->project->chk_exist($data['departments'], $data['name'])){
                        $this->session->set_flashdata('warning', 'Project name aalready exist in same department.');
                        redirect('admin/projects');
                        exit;
                    }
                    if($this->project->add($data)) {
                        $this->session->set_flashdata('success', 'Project Added Successfully.');
                        redirect('admin/projects');
                    }                    
                }
                $this->session->set_flashdata('error', 'Something Went Wrong.');
                redirect('admin/projects');
            }
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/projects');
        }
        $data['projects'] = $this->project->get_unclosed_projects();
        $data['departments'] = $this->department->get_active_departments();
        $this->load->view('admin/projects', $data);
    }

    public function edit_project($id) {
        $data['project'] = $this->project->get_project($id);
        $data['departments'] = $this->department->get_departments();
        $this->load->view('admin/ajax/edit_project', $data);
    }

    public function show_project($id) {
        $data['project'] = $this->project->get_project($id);
        $this->load->view('admin/ajax/show_project', $data);        
    }

    public function close_project($id) {
        $this->project->update($id, ['status' => 2]);
        $this->projects();
    }

    public function project_status($id) {
        $this->project->status($id);
        $project = $this->project->get_project($id);
        echo $project->status?'<span class="badge badge-success"> Active </span>':'<span class="badge badge-warning"> Onhold </span>';
    }

    public function closed_projects() {
        $data['projects'] = $this->project->get_type_projects(2);
        $this->load->view('admin/closed_projects', $data);
    }

    //////////////////////////////////////////////// Reports /////////////////////////////////////////////////

    public function pending_requests() {
        $data['inputs'] = $this->input1->get_inputs();
        $this->load->view('admin/pending_requests', $data);
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
            echo "Already Verified!";
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
                    redirect('admin/pending_requests');
                    exit;
                }
                $this->session->set_flashdata('error', 'Something went Wrong.');
                redirect('admin/pending_requests');
                exit;
            }
        }
    }

    public function input_action($input_id, $action) {
        $user = $this->session->userdata('valid_session')['user_id'];
        if($action==0 || $action==2) {
            $this->input1->update($input_id, ['approved_by' => $user, 'status' => $action]);
        }
        $this->pending_requests();
    } 


    public function project_work() {
        $data['projects'] = $this->project->get_unclosed_projects();
        $this->load->view('admin/project_work', $data);
    }

    public function closed_project_work() {
        $data['projects'] = $this->project->get_type_projects(2);
        $this->load->view('admin/closed_project_work', $data);
    } 

    /////////////////////////////////////////////////////////////////////////////////////

    public function project_details($project_id) {
        $data['project_id'] = $project_id;
        $this->load->view('admin/project_details', $data);
    }

    public function user_work($user_id) {
        $data['user'] = $this->user->get_user($user_id);
        $data['user_id'] = $user_id;
        $this->load->view('admin/user_work', $data);
    }

    ///////////////////////////////////////////////////////////////////////////////////

    public function department_work() {
        $data['departments'] = $this->department->get_active_departments();
        $this->load->view('admin/department_work', $data);
    }

    public function department_works($department_id) {
        $data['department'] = $this->department->get_department($department_id);
        $this->load->view('admin/department_works', $data);
    }

}

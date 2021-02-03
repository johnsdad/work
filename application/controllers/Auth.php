<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'user');
    }

	public function index() {
		$this->login();
	}

	public function login() {
        $this->load->library('form_validation', null, 'validation');
		$this->redirect_user();
		if($this->input->post('submitForm')){
			$this->validation->set_rules('email', 'User id or email', 'valid_email|trim|required');
	        $this->validation->set_rules('password', 'Password', 'trim|required');
	        if ($this->validation->run()) {
	            $email = $this->security->xss_clean($this->input->post('email'));
	            $passw = $this->security->xss_clean($this->input->post('password'));
                //echo $email . '/' . md5($passw); exit;
	            if ($this->user->login($email, $passw)) {
	                $this->redirect_user();
	            }
	            $this->session->set_flashdata('error', 'Something went wrong, please try again later.');
                redirect('login');
	        }
	        $this->session->set_flashdata('error', validation_errors());
            redirect('login');
		}
		$this->load->view('auth/login');
	}

	public function redirect_user($after = null) {
       if (!$this->session->has_userdata('valid_session') && !$after) {
            return;
        }
        if ($this->session->has_userdata('after_login')) {
            $url = $this->session->userdata('after_login');
            $this->session->unset_userdata('after_login');
            $url = str_replace('/work', '', $url);
            redirect($url);
        }
        $user_type = $this->session->userdata('valid_session')['type'];
        if ($user_type == 4) {
            $re_uri = 'agent';
        } elseif ($user_type == 3) {
            $re_uri = 'leader';
        } elseif ($user_type == 2) {
            $re_uri = 'manager';
        } elseif ($user_type == 1) {
            $re_uri = 'admin';
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, please try again later.');
            $re_uri = 'login';
        }
        if ($this->input->post('submitType') == 'ajax') {
            if ($user_type) {
                die($re_uri);
            }
            die('0');
        }
        redirect($re_uri);
    }

    public function logout() {
        $this->session->unset_userdata('valid_session');
        redirect('login');
    }
}
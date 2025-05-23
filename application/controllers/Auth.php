<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user_id = $this->userModel->authenticate($username, $password);

            if ($user_id) {
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('user_id', $user_id);
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        redirect('auth');
    }
}

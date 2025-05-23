<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('admin/dashboard');
        $this->load->view('common/footer');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('customers/list');
        $this->load->view('common/footer');

    }

    public function create() {
        $this->load->view('common/header');
        $this->load->view('customers/create');
        $this->load->view('common/footer');

    }

    public function edit($id) {

        $data['customer'] = $this->get_customer_data($id);

        $this->load->view('common/header');
        $this->load->view('customers/edit', $data);
        $this->load->view('common/footer');

    }

    private function get_customer_data($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, site_url("api/customers/$id"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}
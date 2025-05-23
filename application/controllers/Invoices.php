<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('invoices/list');
        $this->load->view('common/footer');
    }

    public function create() {
        $data['customers'] = $this->get_customers_data();
        $this->load->view('common/header');
        $this->load->view('invoices/create', $data);
        $this->load->view('common/footer');
    }

    public function edit($id) {
        $data['invoice'] = $this->get_invoice_data($id);
        $data['customers'] = $this->get_customers_data();
        $this->load->view('common/header');
        $this->load->view('invoices/edit', $data);
        $this->load->view('common/footer');
    }

    private function get_invoice_data($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, site_url("api/invoices/$id"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response);
    }

    private function get_customers_data() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, site_url("api/customers"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    private $modules = [
        'customers' => 'customerModel',
        'invoices' => 'invoiceModel'
    ];

    public function __construct() {
        parent::__construct();
        $this->load->model('customerModel');
        $this->load->model('invoiceModel');
    }

    public function index($module,$id=null) {

        if (!array_key_exists($module, $this->modules)) {
            $this->output->set_status_header(404);
            return;
        }

        $method = $this->input->server('REQUEST_METHOD');

        switch ($method) {
            case 'GET':
                $this->get($module,$id);
                break;
            
            case 'POST':
                $this->post($module);
                break;

            case 'PUT':
                if (!$id) return $this->_response(['error' => 'ID required'], 400);
                $this->put($module,$id);
                break;

            case 'DELETE':
                if (!$id) return $this->_response(['error' => 'ID required'], 400);
                $this->delete($module,$id);
                break;

                
            default:
                $this->_response(['error' => 'Method not allowed'], 405);
                break;
        }
    }

    private function get($module,$id) {
        $model = $this->modules[$module];
        $data = [];
        if ($model) {
            if ($id)
                $data = $this->$model->get($id);
            else
                $data = $this->$model->get_all();
        } else {
            $this->output->set_status_header(404);
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    private function post($module) {
        $model = $this->modules[$module];
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (empty($input)) {
            $this->output->set_status_header(400);
            return;
        }
        
        $id = $this->$model->create($input);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['id' => $id]));
    }


    private function put($module,$id) {
        $model = $this->modules[$module];
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (empty($input)) {
            $this->output->set_status_header(400);
            return;
        }
        
        $id = $this->$model->update($id,$input);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['id' => $id]));
    }

    private function delete($module,$id) {
        $model = $this->modules[$module];
                
        $id = $this->$model->delete($id);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['id' => $id]));
    }
}
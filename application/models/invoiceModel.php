<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class invoiceModel extends CI_Model {

    public function get_all() {
        $this->db->select('invoices.*, customers.name as customer_name');
        $this->db->from('invoices');
        $this->db->join('customers', 'customers.id = invoices.customer_id');
        return $this->db->get()->result();
    }

    public function get($id) {
        return $this->db->get_where('invoices', ['id' => $id])->row();
    }

    public function create($data) {
        $this->db->insert('invoices', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('invoices', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('invoices');
    }
}
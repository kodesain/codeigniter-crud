<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payments_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $this->db->order_by('pay_name', 'ASC');

        $query = $this->db->get('payments');
        return $query->result_array();
    }

    public function getById($id) {
        $query = $this->db->get_where('payments', array('pay_id' => trim($id)));
        return $query->row_array();
    }

    public function create() {
        $data = array(
            'pay_name' => trim($this->input->post('pay_name')),
            'pay_description' => trim($this->input->post('pay_description'))
        );

        return $this->db->insert('payments', $data);
    }

    public function update($id) {
        $data = array(
            'pay_name' => trim($this->input->post('pay_name')),
            'pay_description' => trim($this->input->post('pay_description'))
        );

        return $this->db->update('payments', $data, array('pay_id' => trim($id)));
    }

    public function delete($id) {
        return $this->db->delete('payments', array('pay_id' => trim($id)));
    }

}

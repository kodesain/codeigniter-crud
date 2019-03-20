<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shipping_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $this->db->order_by('ship_name', 'ASC');

        $query = $this->db->get('shipping');
        return $query->result_array();
    }

    public function getById($id) {
        $query = $this->db->get_where('shipping', array('ship_id' => trim($id)));
        return $query->row_array();
    }

    public function create() {
        $data = array(
            'ship_name' => trim($this->input->post('ship_name')),
            'ship_description' => trim($this->input->post('ship_description')),
            'ship_image' => trim($this->input->post('ship_image'))
        );

        return $this->db->insert('shipping', $data);
    }

    public function update($id) {
        $data = array(
            'ship_name' => trim($this->input->post('ship_name')),
            'ship_description' => trim($this->input->post('ship_description')),
            'ship_image' => trim($this->input->post('ship_image'))
        );

        return $this->db->update('shipping', $data, array('ship_id' => trim($id)));
    }

    public function delete($id) {
        return $this->db->delete('shipping', array('ship_id' => trim($id)));
    }

}

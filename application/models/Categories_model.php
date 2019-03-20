<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $this->db->order_by('cat_name', 'ASC');

        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function getById($id) {
        $query = $this->db->get_where('categories', array('cat_id' => trim($id)));
        return $query->row_array();
    }

    public function create() {
        $data = array(
            'cat_name' => trim($this->input->post('cat_name')),
            'cat_description' => trim($this->input->post('cat_description'))
        );

        return $this->db->insert('categories', $data);
    }

    public function update($id) {
        $data = array(
            'cat_name' => trim($this->input->post('cat_name')),
            'cat_description' => trim($this->input->post('cat_description'))
        );

        return $this->db->update('categories', $data, array('cat_id' => trim($id)));
    }

    public function delete($id) {
        return $this->db->delete('categories', array('cat_id' => trim($id)));
    }

}

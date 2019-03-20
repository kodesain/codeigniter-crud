<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'products.cat_id = categories.cat_id', 'left');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getById($id) {
        $query = $this->db->get_where('products', array('prod_id' => trim($id)));
        return $query->row_array();
    }

    public function create() {
        $data = array(
            'cat_id' => trim($this->input->post('cat_id')),
            'prod_name' => trim($this->input->post('prod_name')),
            'prod_description' => trim($this->input->post('prod_description')),
            'prod_image' => trim($this->input->post('prod_image')),
            'prod_price' => trim($this->input->post('prod_price')),
            'prod_created' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('products', $data);
    }

    public function update($id) {
        $data = array(
            'cat_id' => trim($this->input->post('cat_id')),
            'prod_name' => trim($this->input->post('prod_name')),
            'prod_description' => trim($this->input->post('prod_description')),
            'prod_image' => trim($this->input->post('prod_image')),
            'prod_price' => trim($this->input->post('prod_price')),
            'prod_updated' => date('Y-m-d H:i:s')
        );

        return $this->db->update('products', $data, array('prod_id' => trim($id)));
    }

    public function delete($id) {
        return $this->db->delete('products', array('prod_id' => trim($id)));
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categories_model');
    }

    public function index() {
        $data = array();
        $data['categories'] = $this->categories_model->get();
        $data['content'] = $this->load->view('categories/index', $data, true);

        $this->load->view('layout', $data);
    }

    public function create() {
        $this->form_validation->set_rules([
            ['field' => 'cat_name', 'label' => 'Name', 'rules' => 'required'],
            ['field' => 'cat_description', 'label' => 'Description', 'rules' => 'required']
        ]);

        if ($this->form_validation->run()) {
            $this->categories_model->create();
            $this->session->set_flashdata('success', 'Category has been successfully saved');

            redirect('categories');
        }

        $data = array();
        $data['content'] = $this->load->view('categories/create', $data, true);

        $this->load->view('layout', $data);
    }

    public function edit($id = NULL) {
        if (!isset($id)) {
            redirect('categories');
        }

        $this->form_validation->set_rules([
            ['field' => 'cat_id', 'label' => 'Id', 'rules' => 'required'],
            ['field' => 'cat_name', 'label' => 'Name', 'rules' => 'required'],
            ['field' => 'cat_description', 'label' => 'Description', 'rules' => 'required']
        ]);

        if ($this->form_validation->run()) {
            $this->categories_model->update($id);
            $this->session->set_flashdata('success', 'Category has been successfully updated');

            redirect('categories');
        }

        $data = array();
        $data['category'] = $this->categories_model->getById($id);
        $data['content'] = $this->load->view('categories/edit', $data, true);

        $this->load->view('layout', $data);
    }

    public function delete($id = NULL) {
        if (!isset($id)) {
            redirect('categories');
        }

        $this->categories_model->delete($id);
        $this->session->set_flashdata('success', 'Category has been successfully deleted');

        redirect('categories');
    }

}

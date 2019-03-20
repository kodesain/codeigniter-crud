<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('products_model');
        $this->load->model('categories_model');
    }

    public function index() {
        $data = array();
        $data['products'] = $this->products_model->get();
        $data['content'] = $this->load->view('products/index', $data, true);

        $this->load->view('layout', $data);
    }

    public function create() {
        $this->form_validation->set_rules([
            ['field' => 'prod_name', 'label' => 'Name', 'rules' => 'required'],
            ['field' => 'prod_description', 'label' => 'Description', 'rules' => 'required']
        ]);

        if ($this->input->method() == 'post') {
            $upload = $this->upload('image_file');
            if (!empty($upload)) {
                if ($upload['error'] == 0) {
                    $_POST['prod_image'] = $upload['location'];
                } else {
                    $this->form_validation->set_rules('image_file', 'Image File', 'required', array('required' => $upload['message']));
                }
            }
        }

        if ($this->form_validation->run()) {
            $this->products_model->create();
            $this->session->set_flashdata('success', 'Product has been successfully saved');

            redirect('products');
        }

        $data = array();
        $data['categories'] = $this->categories_model->get();
        $data['content'] = $this->load->view('products/create', $data, true);

        $this->load->view('layout', $data);
    }

    public function edit($id = NULL) {
        if (!isset($id)) {
            redirect('products');
        }

        $this->form_validation->set_rules([
            ['field' => 'prod_id', 'label' => 'Id', 'rules' => 'required'],
            ['field' => 'prod_name', 'label' => 'Name', 'rules' => 'required'],
            ['field' => 'prod_description', 'label' => 'Description', 'rules' => 'required']
        ]);

        if ($this->input->method() == 'post') {
            $upload = $this->upload('image_file');
            if (!empty($upload)) {
                if ($upload['error'] == 0) {
                    $_POST['prod_image'] = $upload['location'];
                } else {
                    $this->form_validation->set_rules('image_file', 'Image File', 'required', array('required' => $upload['message']));
                }
            }
        }

        if ($this->form_validation->run()) {
            $this->products_model->update($id);
            $this->session->set_flashdata('success', 'Product has been successfully updated');

            redirect('products');
        }

        $data = array();
        $data['categories'] = $this->categories_model->get();
        $data['product'] = $this->products_model->getById($id);
        $data['content'] = $this->load->view('products/edit', $data, true);

        $this->load->view('layout', $data);
    }

    public function delete($id = NULL) {
        if (!isset($id)) {
            redirect('products');
        }

        $this->products_model->delete($id);
        $this->session->set_flashdata('success', 'Product has been successfully deleted');

        redirect('products');
    }

    protected function upload($field) {
        if (is_uploaded_file($_FILES[$field]['tmp_name'])) {
            $path = './files/products/';

            $this->upload->initialize(array(
                'upload_path' => $path,
                'allowed_types' => 'gif|jpg|jpeg|png',
                'max_size' => 0,
                'max_width' => 1000,
                'max_height' => 1000
            ));

            if ($this->upload->do_upload($field)) {
                $data = $this->upload->data();
                $data['error'] = 0;
                $data['location'] = $path . $this->upload->data('file_name');

                return $data;
            } else {
                return array(
                    'error' => 1,
                    'message' => strip_tags($this->upload->display_errors())
                );
            }
        } else {
            return NULL;
        }
    }

}

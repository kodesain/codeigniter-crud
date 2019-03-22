<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('payments_model');
    }

    public function index() {
        $data = array();
        $data['content'] = $this->load->view('payments/index', $data, true);

        $this->load->view('layout', $data);
    }

    public function show($id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'success';

        if (empty($id)) {
            $data = $this->payments_model->get();
        } else {
            $data = $this->payments_model->getById($id);
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        )));
    }

    public function save($id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'failed';

        $this->form_validation->set_rules([
            ['field' => 'pay_name', 'label' => 'Payment', 'rules' => 'required'],
            ['field' => 'pay_description', 'label' => 'Description', 'rules' => 'required']
        ]);

        if ($this->form_validation->run()) {
            if (empty($id)) {
                $this->payments_model->create();
                $status = 'success';
                $message = 'Payment has been successfully saved';
            } else {
                $this->payments_model->update($id);
                $status = 'success';
                $message = 'Payment has been successfully updated';
            }
        } else {
            $message = $this->form_validation->error_string();
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        )));
    }

    public function drop($id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'failed';

        if (empty($id)) {
            $message = 'ID is required';
        } else {
            $this->payments_model->delete($id);
            $status = 'success';
            $message = 'Payment has been successfully deleted';
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        )));
    }

}

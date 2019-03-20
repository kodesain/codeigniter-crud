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

    public function read($id = NULL) {
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
        $message = array();
        $data = NULL;
        $status = 'failed';

        if (trim($this->input->post('pay_name')) == '') {
            array_push($message, 'Payment is required');
        }

        if (trim($this->input->post('pay_description')) == '') {
            array_push($message, 'Description is required');
        }

        if (empty($message)) {
            if (empty($id)) {
                $this->payments_model->create();
                $status = 'success';
                $message = 'Payment has been successfully saved';
            } else {
                $this->payments_model->update($id);
                $status = 'success';
                $message = 'Payment has been successfully updated';
            }
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        )));
    }

    public function delete($id = NULL) {
        $message = array();
        $data = NULL;
        $status = 'failed';

        if (empty($id)) {
            array_push($message, 'ID is required');
        }

        if (empty($message)) {
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

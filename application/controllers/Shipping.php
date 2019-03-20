<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shipping extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('shipping_model');
    }

    public function index() {
        $data = array();
        $data['shipping'] = $this->shipping_model->get();
        $data['content'] = $this->load->view('shipping/index', $data, true);

        $this->load->view('layout', $data);
    }

    public function read($id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'success';

        if (empty($id)) {
            $data = $this->shipping_model->get();
        } else {
            $data = $this->shipping_model->getById($id);
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

        if (trim($this->input->post('ship_name')) == '') {
            array_push($message, 'Shipping is required');
        }

        if (trim($this->input->post('ship_description')) == '') {
            array_push($message, 'Description is required');
        }

        if (empty($message)) {
            $upload = $this->upload('image_file');
            if (!empty($upload)) {
                if ($upload['error'] == 0) {
                    $_POST['ship_image'] = $upload['location'];
                } else {
                    array_push($message, $upload['message']);
                }
            }
        }

        if (empty($message)) {
            if (empty($id)) {
                $this->shipping_model->create();
                $status = 'success';
                $message = 'Shipping has been successfully saved';
            } else {
                $this->shipping_model->update($id);
                $status = 'success';
                $message = 'Shipping has been successfully updated';
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
            $this->shipping_model->delete($id);
            $status = 'success';
            $message = 'Shipping has been successfully deleted';
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        )));
    }

    protected function upload($field) {
        if (is_uploaded_file($_FILES[$field]['tmp_name'])) {
            $path = './files/shipping/';

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

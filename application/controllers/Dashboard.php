<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        $data['content'] = $this->load->view('dashboard', $data, true);

        $this->load->view('layout', $data);
    }

}

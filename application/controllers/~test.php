<?php

class test extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
}

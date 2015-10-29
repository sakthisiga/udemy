<?php

class test extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function fun()
    {
    	$this->load->view('home/inc/header_view');
    	$this->load->view('home/test_view');
    	$this->load->view('home/inc/footer_view');
    }
}

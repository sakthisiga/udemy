<?php

// Home Class Begins
class Home extends CI_Controller {
	
        //-------------------------------------------------------------------------------------------
        //Function : Load Home View (Login Page)
        //-------------------------------------------------------------------------------------------
	public function index()
	{
		$this->load->view('home/inc/header_view');
		$this->load->view('home/home_view');
		$this->load->view('home/inc/footer_view');
	}
        
        //-------------------------------------------------------------------------------------------
        //Function : Loads Register View for New User Registration
        //-------------------------------------------------------------------------------------------
        
        public function register()
        {
                $this->load->view('home/inc/header_view');
		$this->load->view('home/register_view');
		$this->load->view('home/inc/footer_view');
        }
}

// Home Class Ends
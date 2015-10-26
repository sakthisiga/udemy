<?php

// Dashboard Class Begins

class Dashboard extends CI_Controller {
	
        public function __construct() {
            parent::__construct();
            $user_id = $this->session->userdata('user_id');
            if(!$user_id)
            {
                $this->logout();
            }
        }
        
        //-------------------------------------------------------------------------------------------
        //Function : Load the Dashboard View
        //-------------------------------------------------------------------------------------------
        
	public function index()
	{
		/* $this->load->view('dashboard/inc/header_view');
		$this->load->view('dashboard/dashboard_view');
		$this->load->view('dashboard/inc/footer_view'); */
		
		$data['main_content'] = 'dashboard_view';
		$this->load->view('dashboard/inc/template_view', $data);
	}
	
        //-------------------------------------------------------------------------------------------
        //Function : Logout from application (Loads login page)
        //-------------------------------------------------------------------------------------------
        
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/");
	}
}

// Dashboard Class Ends
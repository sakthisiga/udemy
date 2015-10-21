<?php

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login()
    {
        
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        
        $result = $this->user_model->get([
            'username' => $username,
            'password' => $password
        ]);
        
        $this->output->set_content_type('application_json');
        
        if($result)
        {
            $this->session->set_userdata(['user_id' => $result[0]['user_id']]);
            $this->output->set_output(json_encode(['result' => '1']));
            return false;
        }
        $this->output->set_output(json_encode(['result' => '0']));
       
        
        
        $session = $this->session->all_userdata('user_id');
        print_r($session);
    }
}

<?php

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function login()
    {
        
        $this->output->set_content_type('application_json');
        
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() == FALSE)
        {
            $this->output->set_output(json_encode(['result' => '0','error' => $this->form_validation->error_array()]));
            return false;
        }
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $result = $this->user_model->get([
            'username' => $username,
            'password' => hash('sha256',$password.PASS)
        ]);
        
        
        
        if($result)
        {
            $this->session->set_userdata(['user_id' => $result[0]['user_id']]);
            $this->output->set_output(json_encode(['result' => '1']));
            return false;
        }
        else 
        {
            $this->output->set_output(json_encode(['result' => '0', 'error2' => 'Invalid Credentials, please try again with proper credentials. <br> If you do not have user account, please click "Register" link to create a one ']));
        }
        
        
        $session = $this->session->all_userdata('user_id');
        //print_r($session);
    }
    
    
     public function register()
    {
        $this->output->set_content_type('application_json');
        
        $this->form_validation->set_rules('username','Username','required|min_length[4]|max_length[8]|is_unique[user.username]');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[20]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required|min_length[4]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->output->set_output(json_encode(['result' => '0','error' => $this->form_validation->error_array()]));
            return false;
        }
        $username = $this->input->post('username');
        $email= $this->input->post('email');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        
        $user_id = $this->user_model->insert([
            'username' => $username,
            'password' => hash('sha256',$password.PASS),
            'email' => $email
        ]);  
        
        
        if($user_id)
        {
            $this->session->set_userdata(['user_id' => $user_id]);
            $this->output->set_output(json_encode(['result' => '1']));
            return false;
        }
        else 
        {
            $this->output->set_output(json_encode(['result' => '0', 'error' => 'User not Created']));
        }
        
        
        $session = $this->session->all_userdata('user_id');
        //print_r($session);
    }
}

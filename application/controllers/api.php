<?php

// Api Class Begins

class Api extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Check User login status
    //-------------------------------------------------------------------------------------------
    
    private function _require_login()
    {
        if($this->session->userdata('user_id') == false)
        {
            $this->output->set_output(json_encode(['result' => '0', 'error' => 'You are not authorized']));
            return false;
        }
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Login into application
    //-------------------------------------------------------------------------------------------
    
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
        
        $this->load->model('user_model');
          
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
    
    //-------------------------------------------------------------------------------------------
    //Function : New User Registration
    //-------------------------------------------------------------------------------------------
    
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
        
        $this->load->model('user_model');
          
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
    
    //-------------------------------------------------------------------------------------------
    //Function : Create a Todo Item
    //-------------------------------------------------------------------------------------------
    
    public function create_todo()
    {
        $this->_require_login();
        
        $this->output->set_content_type('application_json');
        
        //Form Validation
        $this->form_validation->set_rules('content','Content','required|min_length[10]|max_length[100]');
        
        if($this->form_validation->run() == false)
        {
        	$this->output->set_output(json_encode([
        			'result' => '0',
        			'error' => $this->form_validation->error_array()
        	]));
        	return false;
        }
        
        //Inserting data
        $result = $this->db->insert('todo', [
        		'content' => $this->input->post('content'),
        		'user_id' => $this->session->userdata('user_id')
        ]);
        
        if($result)
        {
        	// Get fresh list to be posted to DOM
        	
        	$query = $this->db->get_where('todo',['todo_id' => $this->db->insert_id()]);
        	$this->output->set_output(json_encode([
        			'result' => '1',
        			'output' => 'New Todo Added',
        			'data' => $query->result()
        	]));
        	return false;
        }
        else
        {
        	$this->output->set_output(json_encode(['result' => '0']));
        }
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Get the Todo Item
    //-------------------------------------------------------------------------------------------
    
    public function get_todo($id = NULL)
    {
        $this->_require_login();
        
        if($id != NULL)
        {
        	$this->db->where([
        			'todo_id' => $id,
        			'user_id' => $this->session->userdata('user_id')
        			
        	]);
        }
        else
        {
        	$this->db->where('user_id',$this->session->userdata('user_id'));
        }
        
        $query = $this->db->get('todo');
        $result = $query->result();
        
        $this->output->set_output(json_encode($result));
        
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Update a Todo Item
    //-------------------------------------------------------------------------------------------
    
    public function update_todo()
    {
    	$this->_require_login();
    	$todo_id = $this->input->post('id');
    	$completed = $this->input->post('completed');

    	$this->db->where(['todo_id' => $todo_id]);
    	$this->db->update('todo',[
    			'completed' => $completed
    	]);
    	
    	$result = $this->db->affected_rows();
    	
    if($result)
    	{
	    	$this->output->set_output(json_encode(['result' => '1']));
	    	return false;
    	}
    	else
    	{
    		$this->output->set_output(json_encode([
    				'result' => '0',
    				'message' => 'Could not Updated'
    		]));
    		return false;
    	}
    	
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Delete a Todo Item
    //-------------------------------------------------------------------------------------------
    
    public function delete_todo()
    {
        $this->_require_login();
        
        $result = $this->db->delete('todo',[
        		'todo_id' => $this->input->post('todo_id'),
        		'user_id' => $this->session->userdata('user_id')
        ]);
        
        if($result)
        {
        	$this->output->set_output(json_encode(['result' => '1']));
        	return false;
        }
        else 
        {
        	$this->output->set_output(json_encode([
        			'result' => '0',
        			'message' => 'Could not delete'
        			
        	]));
        }
        
    }
        
    //-------------------------------------------------------------------------------------------
    //Function : Create a Note Item
    //-------------------------------------------------------------------------------------------
    
    public function create_note()
    {
        $this->_require_login();
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Update a Note Item
    //-------------------------------------------------------------------------------------------
    
    public function update_note()
    {
        $this->_require_login();
        $note_id = $this->input->post('note_id');
    }
    
    //-------------------------------------------------------------------------------------------
    //Function : Delete a Note Item
    //-------------------------------------------------------------------------------------------
    
    public function delete_note()
    {
        $this->_require_login();
        $note_id = $this->input->post('note_id');
    }
}

// Api Class Ends
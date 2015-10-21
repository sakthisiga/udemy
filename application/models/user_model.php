<?php

class User_model extends CI_Model {
    
    
    public function get($user_id = NULL)
    {
        if($user_id === NULL)
        {
            $q = $this->db->get('user');
        }
        elseif(is_array($user_id))
        {
            $q=$this->db->get_where('user',$user_id);
        }
        else
        {
            $q=$this->db->get_where('user',['user_id' => $user_id]);
        }
        
        return $q->result_array();
    }
    
    public function insert($data)
    {
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }
            
}

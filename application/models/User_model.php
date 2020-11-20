<?php 
  class User_model extends CI_Model{
    public function register($enc_password)
    {
       //User data to be stored in array
       $data = array(
         'name' => $this->input->post('name'),
         'zipcode' => $this->input->post('zipcode'),
         'email' => $this->input->post('email'),
         'username' => $this->input->post('username'),
         'password' => $enc_password
       );
       //insert user to database table
       return $this->db->insert('users',$data);
    }

    public function login($username, $password)
    {
      //validate the user
      $this->db->where('username',$username);
      $this->db->where('password',$password);

      $result = $this->db->get('users');

      if($result->num_rows()==1)
      {
        return $result->row(0)->id;
      }
      else
      {
        return false;
      }
    }
   
  }

?>
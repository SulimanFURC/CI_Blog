<?php 
  class Users extends CI_Controller{
    //user registration
    public function register()
    {
      $data['title'] = 'Sign up';
      $this->form_validation->set_rules('name','Name','required');
      $this->form_validation->set_rules('username','Username','required');
      $this->form_validation->set_rules('email','Email','required');
      $this->form_validation->set_rules('password','Password','required');
      $this->form_validation->set_rules('password2','Confirm Password','matches[password]');

      if ($this->form_validation->run() == FALSE) 
      {
        $this->load->view('template/header');
        $this->load->view('users/register',$data);
        $this->load->view('template/footer');
      } else 
      {
        // encrypt Password
        $enc_password = md5($this->input->post('password'));
        $this->user_model->register($enc_password);
        //set message
       $this->session->set_flashdata('user_registered', 'You are now Registered. You can login now!');
        redirect('posts');
      }
    }

    // user login
    public function login()
    {
      $data['title'] = 'Sign in';

      $this->form_validation->set_rules('username','Username','required');
      $this->form_validation->set_rules('password','Password','required');

      if ($this->form_validation->run() == FALSE) 
      {
        $this->load->view('template/header');
        $this->load->view('users/login',$data);
        $this->load->view('template/footer');
      } else 
      {
        //get the name
        $username = $this->input->post('username');
        //get password
        $password = md5($this->input->post('password'));
        //login user
        $user_id = $this->user_model->login($username,$password);

        if($user_id)
        {
          // create session
          if($user_id)
          {
            $user_data = array(
              'user_id' => $user_id,
              'username' => $username,
              'logged_in' => true
            );
            $this->session->set_userdata($user_data);
          }
          //set message
          $this->session->set_flashdata('user_loggedin', 'You are Login...!');
          redirect('posts');
        }
        else
        {
          //set message
          $this->session->set_flashdata('login_failed', 'Invalid Username or password');
          redirect('users/login');
        }
        
      }
    }

    public function logout()
    {
      //unset user data
      $this->session->unset_userdata('logged_in');
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('username');

      //set message for logout
      $this->session->set_flashdata('user_logout','You are logout..!');
      redirect('users/login');
    
    }
  }

?>
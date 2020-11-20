<?php 

  class Posts extends CI_Controller{

    public function index()
    {
      $data['title'] = 'Latest Posts';

      $data['posts'] = $this->post_model->get_posts();

      $this->load->view('template/header');
      $this->load->view('posts/index',$data);
      $this->load->view('template/footer');
    }

    public function view($slug = NULL)
    {
      $data['post'] = $this->post_model->get_posts($slug);
      if(empty($data['post']))
      {
        show_404();
      }

      $data['title'] = $data['post']['title'];
      $this->load->view('template/header');
      $this->load->view('posts/view',$data);
      $this->load->view('template/footer');
    }

    public function create()
    {
      //check if user is login
      if($this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }
      $data['title'] = 'Create Post';

      $data['category'] = $this->post_model->get_category();

      $this->form_validation->set_rules('title','Title','required');
      $this->form_validation->set_rules('body','Body','required');

        if ($this->form_validation->run() === FALSE) 
        {
          $this->load->view('template/header');
          $this->load->view('posts/create',$data);
          $this->load->view('template/footer');
        } else 
        {
          // upload image 
          $config['upload_path'] = './assets/images/posts';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = '3072';
          $config['max_width'] = '500';
          $config['max_height'] = '500';

          $this->load->library('upload',$config);

          if(!$this->upload->do_upload())
          {
            $errors = array('error' => $this->upload->display_errors());
            $post_image = 'Image Not Found';
          }
          else
          {
            $data = array('upload_data' => $this->upload->data());
            $post_image = $_FILES['userfile']['name'];
          }

          $this->post_model->create_post($post_image);
          $this->session->set_flashdata('post_created', 'You have successfuly created the post.');
          redirect('posts');
        }
    }

    public function delete($id)
    {
      $this->post_model->delete_post($id);
      redirect('posts');
    }

    public function edit($slug)
    {
      //check if user is login
      if($this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }
      $data['post'] = $this->post_model->get_posts($slug);
      //check correct user if loggin
      if($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id'])
      {
        redirect('posts');
      }
      $data['category'] = $this->post_model->get_category();

      if(empty($data['post']))
      {
        show_404();
      }

      $data['title'] = 'Edit Post';
      $this->load->view('template/header');
      $this->load->view('posts/edit',$data);
      $this->load->view('template/footer');
    }

    public function update()
    {
      //check if user is login
      if($this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }

      $this->post_model->update_post();
      $this->session->set_flashdata('post_updated', 'You have successfuly Updated the Post.');
      redirect('posts');
    }

  } // class end here

?>
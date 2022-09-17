<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->library('form_validation');
        
	}

	public function index()
	{
		if ($this->session->userdata('is_admin_login')) {
           redirect(base_url().'dashboard', 'refresh');
        }
		$this->load->view('login');
	}

	public function do_login(){
        
        if ($this->session->userdata('is_admin_login')) {
            redirect(base_url().'dashboard', 'refresh');
        } else {
            $user = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg','<div class="alert alert-danger">'.validation_errors().'</div>');
                redirect(base_url(), 'refresh');
                } else {
                
                $login = $this->db->get_where('tbl_users',array('username'=>$user,'password'=>$password));	

                if ($login->num_rows() == 1) {
                    foreach ($login->result_array() as $recs => $res) {
                        $this->session->set_userdata(array(
                            'id' => $res['id'],
                            'username' => $res['username'],                             
                            'is_admin_login' => true
                                )
                        );
                    }
                    redirect(base_url().'dashboard', 'refresh');
                    
                } else {
                    
                    $this->session->set_flashdata('msg','<div class="alert alert-danger"><strong>Access Denied</strong> Invalid Username/Password</div>');
                   redirect(base_url(), 'refresh');
                }
            }
        }
          
         
    }

    public function do_signout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('is_admin_login');   
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('login', 'refresh');
    } 
}

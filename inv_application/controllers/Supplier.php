<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) 
        {
           redirect(base_url().'login', 'refresh');
        }
        if( !$this->inventory->check_permission('suppliers',$this->session->userdata('id')) )
        {
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index()
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "supplier";
		$this->load->view('add_supplier',$data);
	}

	public function do_add()
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
		$sql = $this->db->get_where('tbl_supplier',array('email'=>$this->input->post('email')));
		if($sql->num_rows()==0){
			$this->form_validation->set_rules('name', 'Supplier Name', 'required');
			// $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Contact Number', 'required');
			if($this->form_validation->run() == FALSE){
				echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
			}
			else
			{
				$data=array(
					'name'		=>$this->input->post('name'),
					'email'		=>$this->input->post('email'),
					'phone'		=>$this->input->post('phone'),
					'address'	=>$this->input->post('address'),
					'com_name'	=>$this->input->post('com_name'),
					'status' 	=> $this->input->post('status'),
					'insert_by' => $this->session->userdata('id')
				);
				$this->db->insert('tbl_supplier',$data);
				echo 1;
			}
		}
		else
		{
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i><strong>Oops, </strong>'.$this->input->post('email').' already used. Please try with another one.</div>';
		}
	}

	public function view()
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "supplier";
		$data['query'] = $this->db->get_where('tbl_supplier',array('status'=>1));
		$this->load->view('view_supplier',$data);
	}

	public function edit($id)
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "supplier";
        $id = base64_decode(urldecode($id));
        $data['query'] = $this->db->get_where('tbl_supplier',array('id'=>$id));
        $this->load->view('edit_supplier',$data);
	}
	public function do_update($id){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = base64_decode(urldecode($id));
        $data=array(
			'com_name'	=>$this->input->post('name'),
			'email'		=>$this->input->post('email'),
			'phone'		=>$this->input->post('phone'),
			'address'	=>$this->input->post('address'),
			'com_name'	=>$this->input->post('com_name'),
			'update_by' => $this->session->userdata('id'),
			'update_date'=> date('Y-m-d H:i:s')
			);
		$this->db->where('id', $id);
		$this->db->update('tbl_supplier',$data);
		echo 1;
	}

	public function delete($id)
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = base64_decode(urldecode($id));
			$this->db->where('id', $id);
        	$this->db->delete('tbl_supplier');
		}
	}	
}
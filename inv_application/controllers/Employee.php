<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('employees',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $this->db->where(array('is_active'=>1));
        $data['query'] = $this->db->get('tbl_users');
        $data['page'] = "employee";
		$this->load->view('add_employee',$data);
	}

	public function do_add()
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
		$sql = $this->db->get_where('tbl_users',array('username'=>$this->input->post('username')));
		if($sql->num_rows()==0)
		{
			$this->form_validation->set_rules('name', 'Employee Name', 'required');
			$this->form_validation->set_rules('designation', 'Designation', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('msg','<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>');
				redirect(base_url().'employee', 'refresh');
			}
			else
			{
				$data=array(
					'name'=>$this->input->post('name'),
					'designation'=>$this->input->post('designation'),
					'email'=>$this->input->post('email'),
					'contact'=>$this->input->post('contact'),
					'username'=>$this->input->post('username'),
					'password'=>md5($this->input->post('password')),
					'address'=>$this->input->post('address'),
					'salary'=>$this->input->post('salary'),
					'is_active'=>$this->input->post('status'),
					'insert_by'=>$this->session->userdata('id')
					
					);
				$success = $this->db->insert('tbl_users',$data);
				$employee_id = $this->db->insert_id();
				$grants_data = $this->input->post("grants")!=FALSE ? $this->input->post("grants"):array();
				if($success)
				{
					foreach($grants_data as $permission_id)
					{
						$success = $this->db->insert('tbl_grants',
						array(
						'permission_id'=>$permission_id,
						'person_id'=>$employee_id));
					}
				}
				$this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i><strong>Done, </strong> Employee has been created.</div>');
				redirect(base_url().'employee', 'refresh');
			}
		}
		else{
			$this->session->set_flashdata('msg','<div class="alert alert-danger"><i class="icon fa fa-ban"></i><strong>Oops, </strong>'.$this->input->post('username').' Account Already Exist. Please try with another one.</div>');
			redirect(base_url().'employee', 'refresh');
		}
	}


	public function edit($id)
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
        $id = base64_decode(urldecode($id));
        $data['page'] = "employee";
        // $id = $this->uri->segment(3);
        $data['query'] = $this->db->get_where('tbl_users',array('id'=>$id));
        $this->load->view('edit_employee',$data);
	}

	public function do_update($id)
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        // $id = $this->uri->segment(3);
        $id = base64_decode(urldecode($id));
        $data=array(
			'name'			=> $this->input->post('name'),
			'designation' 	=> $this->input->post('designation'),
			'email' 		=> $this->input->post('email'),
			'contact' 		=> $this->input->post('contact'),
			'address' 		=> $this->input->post('address'),
			'salary' 		=> $this->input->post('salary'),
			'is_active' 	=> $this->input->post('status'),
			'update_by' 	=> $this->session->userdata('id'),
			'update_date' 	=> date('Y-m-d H:i:s'),
			);
		$this->db->where('id', $id);
		$success = $this->db->update('tbl_users',$data);

		$grants_data = $this->input->post("grants")!=FALSE ? $this->input->post("grants"):array();
		//We have either inserted or updated a new employee, now lets set permissions.
		if($success)
		{
			//First lets clear out any grants the employee currently has.
			$success = $this->db->delete('tbl_grants', array('person_id' => $id));
			if($success){
				foreach($grants_data as $permission_id)
				{
					$success = $this->db->insert('tbl_grants',
					array(
					'permission_id'=>$permission_id,
					'person_id'=>$id));
				}
			}
		}
		$this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i><strong>Done, </strong> information successfully updated.</div>');
				redirect(base_url().'employee', 'refresh');
		
	}

	public function delete($id)
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$data = array();
			// $id = $this->uri->segment(3);
			$id = base64_decode(urldecode($id));
			$data=array(
			'is_active'=>0
			);
			$this->db->where('id', $id);
        	$success = $this->db->update('tbl_users',$data);
        	// $success = $this->db->delete('tbl_users');
        	if($success){
        		$this->db->where('person_id', $id);
        		$this->db->delete('tbl_grants');
        	}
		}
	}

	public function view_balance()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "accounts";
        $data['query'] = $this->db->get('tbl_accounts');
        $this->load->view('view_account_balance', $data);
	}	
}
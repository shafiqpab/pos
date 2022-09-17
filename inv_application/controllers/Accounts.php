<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('accounts',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['query'] = $this->db->get('tbl_accounts');
        $data['page'] = "accounts";
		$this->load->view('add_accounts',$data);
	}

	public function do_add(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		$sql = $this->db->get_where('tbl_accounts',array('acoount_name'=>$this->input->post('acoount_name')));
		if($sql->num_rows()==0){
			$this->form_validation->set_rules('acoount_name', 'Account Name', 'required');
			
			if($this->form_validation->run() == FALSE){
				echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
			}else{
				$data=array(
					'acoount_name'=>$this->input->post('acoount_name'),
					'account_number'=>$this->input->post('ac_num'),
					'initial_balance'=>$this->input->post('initial_balance'),
					'note'=>$this->input->post('note')
					
					);
				$this->db->insert('tbl_accounts',$data);
				echo 1;
			}
		}
		else{
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i><strong>Oops, </strong>'.$this->input->post('acoount_name').' Account Already Exist. Please try with another one.</div>';
		}
	}


	public function edit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "accounts";
        $id = $this->uri->segment(3);
        $data['query'] = $this->db->get_where('tbl_accounts',array('account_id'=>$id));
        $this->load->view('edit_accounts',$data);
	}
	public function do_update(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = $this->uri->segment(3);
        $data=array(
			'acoount_name'=>$this->input->post('acoount_name'),
			'account_number'=>$this->input->post('ac_num'),
			'initial_balance'=>$this->input->post('initial_balance'),
			'note'=>$this->input->post('note')
			);
		$this->db->where('account_id', $id);
		$this->db->update('tbl_accounts',$data);
		echo 1;
	}

	public function delete(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $this->uri->segment(3);
			$this->db->where('account_id', $id);
        	$this->db->delete('tbl_accounts');
		}
	}

	public function view_balance(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "accounts";
        $data['query'] = $this->db->get('tbl_accounts');
        $this->load->view('view_account_balance', $data);
	}	
}
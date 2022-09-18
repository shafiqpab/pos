<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('expense',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "expense";
		$data['query'] = $this->db->get('tbl_expense');
		$this->load->view('add_expense',$data);
	}

	public function do_add()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }		

		$this->form_validation->set_rules('expense_for', 'Expense For', 'required');
		$this->form_validation->set_rules('mode', 'Payment Mood', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		if($this->form_validation->run() == FALSE)
		{
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
		}
		else
		{
			$data=array(
					'expense_for'=>$this->input->post('expense_for'),
					'amount'=>$this->input->post('amount'),
					'reference_no'=>$this->input->post('reference'),
					'expense_date'=>$this->input->post('date'),
					'remarks'=>$this->input->post('remarks'),
					'pay_mood'=>$this->input->post('mode'),
					'is_active'=>1,
					'insert_by'=>$this->session->userdata('id')
					);
				$this->db->insert('tbl_expense',$data);
				echo 1;
		}
	}

	public function view()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "expense";
		$data['query'] = $this->db->get_where('tbl_expense',array('is_active'=>1));
		$this->load->view('view_expense',$data);
	}

	public function edit()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "expense";
        $id = $this->uri->segment(3);
        $data['query'] = $this->db->get_where('tbl_expense',array('id'=>$id));
        $this->load->view('edit_expense',$data);
	}
	public function do_update()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = $this->uri->segment(3);
        $data=array(
			'expense_for'=>$this->input->post('expense_for'),
			'amount'=>$this->input->post('amount'),
			'reference_no'=>$this->input->post('reference'),
			'expense_date'=>$this->input->post('date'),
			'remarks'=>$this->input->post('remarks'),
			'pay_mood'=>$this->input->post('mode'),
			'update_by' 	=> $this->session->userdata('id'),
			'update_date' 	=> date('Y-m-d H:i:s')
			);
		$this->db->where('id', $id);
		$this->db->update('tbl_expense',$data);
		echo 1;
	}

	public function delete()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $this->uri->segment(3);
			$this->db->where('id', $id);
        	// $this->db->delete('tbl_warehouse');
        	$this->db->update('tbl_expense',array('is_active'=>0));
		}
	}	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller

{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('transaction',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['query'] = $this->db->get_where('tbl_transactions',array('transaction_type'=>'expense'));
        $data['page'] = "transaction";
		$this->load->view('add_expense',$data);
	}

	public function add_expense(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		
		$this->form_validation->set_rules('account_id', 'Account Name', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required');
		$this->form_validation->set_rules('note', 'Description', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg','<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>');
			redirect(base_url().'transaction','refresh');
		}else{
			$balance = $this->inventory->get_balance($this->input->post('account_id'));
            $new_balance = ($balance - $this->input->post('amount'));
            $transaction_id = uniqid();
			$data=array(
				'account_id'=>$this->input->post('account_id'),
				'transaction_id'=>$transaction_id,
				'payment'=>$this->input->post('amount'),
				'balance'=>$new_balance,
				'transaction_type'=>'expense',
				'mode'=>$this->input->post('mode'),
				'note'=>$this->input->post('note'),
				'date'=>$this->input->post('date')
				);
			$success = $this->db->insert('tbl_transactions',$data);
			if($success){
				// UPDATE ACCOUNT
                    $this->db->where('account_id',$this->input->post('account_id'));
                    $this->db->update('tbl_accounts', array('initial_balance'=>$new_balance));
                }

			$this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i> Done, Expense Added.</div>');
			redirect(base_url().'transaction','refresh');
			
		}
		
	}

	public function expense_edit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "transaction";
        $id = $this->uri->segment(3);
        $data['query'] = $this->db->get_where('tbl_transactions',array('id'=>$id));
        $this->load->view('edit_expense',$data);
	}

	public function update_expense(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = $this->uri->segment(3);
        $data=array(
			'account_id'=>$this->input->post('account_id'),
			'payment'=>$this->input->post('amount'),
			'transaction_type'=>'expense',
			'mode'=>$this->input->post('mode'),
			'note'=>$this->input->post('note'),
			'date'=>$this->input->post('date')
			);
		$this->db->where('id', $id);
		$this->db->update('tbl_transactions',$data);

		$this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i> Done, Information updated.</div>');
			redirect(base_url().'transaction','refresh');
		
	}

	public function delete(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $this->uri->segment(3);
			$this->db->where('id', $id);
        	$this->db->delete('tbl_transactions');
		}
	}

	public function deposit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

        $this->db->where('transaction_type','deposit');
        //$this->db->or_where('transaction_type','pay');
        $data['query'] = $this->db->get('tbl_transactions');
        $data['page'] = "transaction";
		$this->load->view('add_deposit',$data);
	}

	public function add_deposit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		
		$this->form_validation->set_rules('account_id', 'Account Name', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required');
		$this->form_validation->set_rules('mode', 'Payment Mode', 'required');
		$this->form_validation->set_rules('note', 'Description', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg','<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>');
			redirect(base_url().'transaction/deposit','refresh');
		}else{
			$transaction_id = uniqid();
			$data=array(
				'account_id'=>$this->input->post('account_id'),
				'transaction_id'=>$transaction_id,
				'payment'=>$this->input->post('amount'),
				'transaction_type'=>'deposit',
				'mode'=>$this->input->post('mode'),
				'note'=>$this->input->post('note'),
				'date'=>$this->input->post('date')
				);
			$success = $this->db->insert('tbl_transactions',$data);
			if($success){
				$query = $this->db->get_where('tbl_accounts',array('account_id'=>$this->input->post('account_id')));
				$row = $query->result();
				$cur_amount = $row[0]->initial_balance;
				$new_balance = $cur_amount + $this->input->post('amount');

				$this->db->where('account_id',$this->input->post('account_id')); 
				$this->db->update('tbl_accounts',array('initial_balance'=>$new_balance));
			}

			$this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i> Done, Deposite has been added.</div>');
			redirect(base_url().'transaction/deposit','refresh');
			
		}
		
	}

	public function deposit_edit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "transaction";
        $id = $this->uri->segment(3);
        $data['query'] = $this->db->get_where('tbl_transactions',array('id'=>$id));
        $this->load->view('edit_deposit',$data);
	}

	public function update_deposit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = $this->uri->segment(3);
        $data=array(
				'account_id'=>$this->input->post('account_id'),
				'payment'=>$this->input->post('amount'),
				'mode'=>$this->input->post('mode'),
				'note'=>$this->input->post('note'),
				'date'=>$this->input->post('date')
				);
		$this->db->where('id', $id);
		$success = $this->db->update('tbl_transactions',$data);

		if($success){
				$query = $this->db->get_where('tbl_accounts',array('account_id'=>$this->input->post('account_id')));
				$row = $query->result();
				$cur_amount = $row[0]->initial_balance;
				$new_balance = $cur_amount + $this->input->post('amount');

				$this->db->where('account_id',$this->input->post('account_id')); 
				$this->db->update('tbl_accounts',array('initial_balance'=>$new_balance));
			}

		$this->session->set_flashdata('msg','<div class="alert alert-success"><i class="icon fa fa-check"></i> Done, Information updated.</div>');
			redirect(base_url().'transaction/deposit','refresh');
		
	}

	public function deposit_delete(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $this->uri->segment(3);
			$this->db->where('id', $id);
        	$this->db->delete('tbl_transactions');
		}
	}

	public function view(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "transaction";
        $data['query'] = $this->db->get('tbl_transactions');
		$this->load->view('view_transactions',$data);
	}

	public function balance_sheet(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "transaction";
        $data['query'] = $this->db->get('tbl_accounts');
        $this->load->view('view_balance_sheet',$data);
	}

}
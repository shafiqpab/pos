<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replacement extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');

        if (!$this->session->userdata('is_admin_login')) 
        {
           redirect(base_url().'login', 'refresh');
        }

        if( !$this->inventory->check_permission('replacement',$this->session->userdata('id')) )
        {
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "replacement";
		$this->load->view('add-replacement',$data);
	}

	public function do_add()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		
		$this->form_validation->set_rules('cname', 'replacement Name', 'required');
		$this->form_validation->set_rules('mobile', 'Contact Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required');
		$this->form_validation->set_rules('receive_date', 'REceive Date', 'required');
		$this->form_validation->set_rules('delivery_date', 'Delivery Date', 'required');
		if($this->form_validation->run() == FALSE)
		{
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
		}
		else
		{
			$data=array(
				'customer_name'		=> $this->input->post('cname'),
				'email'				=> $this->input->post('email'),
				'mobile'			=> $this->input->post('mobile'),
				'address'			=> $this->input->post('address'),
				'product_name'		=> $this->input->post('item_name'),
				'model'				=> $this->input->post('model'),
				'code'				=> $this->input->post('item_code'),
				'receive_date'		=> $this->input->post('receive_date'),
				'delivery_date'		=> $this->input->post('delivery_date'),
				'transaction_type'	=> 1,
				'replacement_charge'=> $this->input->post('charge'),
				'item_qnty'			=> $this->input->post('quantity'),
				'remarks'			=> $this->input->post('remarks'),
				'insert_by'			=> $this->session->userdata('id'),
				'is_active'			=> 1
				);
			$this->db->insert('tbl_replacement',$data);
			echo 1;
		}
		
	}

	public function manage_receive(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "replacement";
		$data['query'] = $this->db->order_by('id', 'DESC')->get_where('tbl_replacement',array('is_active'=>1,'transaction_type'=>1));
		$this->load->view('view-replacement',$data);
	}

	public function manage_return(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "replacement";
		$data['query'] = $this->db->order_by('id', 'DESC')->get_where('tbl_replacement',array('is_active'=>1,'transaction_type'=>1));
		$this->load->view('manage-return',$data);
	}

	public function edit($id){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "replacement";
        $id = base64_decode(urldecode($id));
        $data['query'] = $this->db->get_where('tbl_replacement',array('id'=>$id,'transaction_type'=>1));
        $this->load->view('edit-replacement',$data);
	}
	public function do_update($id){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = base64_decode(urldecode($id));
        $data=array(
			'customer_name'		=> $this->input->post('cname'),
			'email'				=> $this->input->post('email'),
			'mobile'			=> $this->input->post('mobile'),
			'address'			=> $this->input->post('address'),
			'product_name'		=> $this->input->post('item_name'),
			'model'				=> $this->input->post('model'),
			'code'				=> $this->input->post('item_code'),
			'receive_date'		=> $this->input->post('receive_date'),
			'delivery_date'		=> $this->input->post('delivery_date'),
			'transaction_type'	=> 1,
			'replacement_charge'=> $this->input->post('charge'),
			'item_qnty'			=> $this->input->post('quantity'),
			'remarks'			=> $this->input->post('remarks'),
			'update_by' 	=> $this->session->userdata('id'),
			'update_date' 	=> date('Y-m-d H:i:s')
			);
		$this->db->where('id', $id);
		$res=$this->db->update('tbl_replacement',$data);
		if($res)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	public function delete($id){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$id = base64_decode(urldecode($id));
			$data=array(
			'is_active'=>0
			);
			$this->db->where('id', $id);
        	$success = $this->db->update('tbl_replacement',$data);
		}
	}	
}
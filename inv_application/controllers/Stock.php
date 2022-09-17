<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('stock',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['query'] = $this->db->get('tbl_stock_details');       
        $data['page'] = "stock";
		$this->load->view('view_stocklist',$data);
	}

	public function addstock(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }       
        $data['page'] = "stock";
		$this->load->view('add_stock',$data);
	}

	public function do_add()
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		$sql = $this->db->get_where('tbl_stock_details',array('stock_name'=>$this->input->post('stock_name')));
		if($sql->num_rows()==0){
			$this->form_validation->set_rules('stock_name', 'Stock Name', 'required');
			$this->form_validation->set_rules('cat_id', 'Category', 'required');
			$this->form_validation->set_rules('cost_price', 'Cost Price', 'required');
			$this->form_validation->set_rules('current_stock', 'Current Stokc', 'required');
			$this->form_validation->set_rules('sell_price', 'Selling Price', 'required');
			$this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
			if($this->form_validation->run() == FALSE){
				echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
			}else{
				$data=array(
					'stock_name'=>$this->input->post('stock_name'),
					'reorder_level'=>$this->input->post('reorder_level'),
					'supplier_id'=>$this->input->post('supplier_id'),
					'company_price'=>$this->input->post('cost_price'),
					'selling_price'=>$this->input->post('sell_price'),
					'stock_quatity'=>$this->input->post('current_stock'),
					'unit_price_single'=>$this->input->post('unit_price_single'),
					'unit_price_per_pcs'=>$this->input->post('unit_price_per_pcs'),
					'unit_price_carton'=>$this->input->post('carton_price'),
					'category'=>$this->input->post('cat_id'),
					'model_no'=>$this->input->post('model_no'),
					'made_by'=>$this->input->post('made_by'),
					'date'=>date('Y-m-d H:i:s'),
					'note'=>$this->input->post('note'),
					'uom'=>$this->input->post('uom'),
					// 'warehouse'=>$this->input->post('warehouse'),
					'insert_by'=>$this->session->userdata('id')

					);
				$this->db->insert('tbl_stock_details',$data);
				echo 1;
			}
		}
		else{
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i><strong>Oops, </strong>'.$this->input->post('stock_name').' already used. Please try another one.</div>';
		}
	}

	public function edit($id)
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = base64_decode(urldecode($id));
        $data['page'] = "stock";
        $data['query'] = $this->db->get_where('tbl_stock_details',array('id'=>$id));
        $this->load->view('edit_stock',$data);
	}
	public function do_update($id)
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
				$data=array(
					'stock_name'=>$this->input->post('stock_name'),
					'reorder_level'=>$this->input->post('reorder_level'),
					'supplier_id'=>$this->input->post('supplier_id'),
					'company_price'=>$this->input->post('cost_price'),
					'stock_quatity'=>$this->input->post('current_stock'),
					'selling_price'=>$this->input->post('sell_price'),
					'unit_price_single'=>$this->input->post('unit_price_single'),
					'unit_price_per_pcs'=>$this->input->post('unit_price_per_pcs'),
					'unit_price_carton'=>$this->input->post('carton_price'),
					'category'=>$this->input->post('cat_id'),
					'model_no'=>$this->input->post('model_no'),
					'made_by'=>$this->input->post('made_by'),
					'date'=>date('Y-m-d H:i:s'),
					'note'=>$this->input->post('note'),
					'uom'=>$this->input->post('uom'),
					// 'warehouse'=>$this->input->post('warehouse'),
					'update_by' 	=> $this->session->userdata('id'),
					'update_date' 	=> date('Y-m-d H:i:s'),

					);
				$id = base64_decode(urldecode($id));
				$this->db->where('id',$id);
				$this->db->update('tbl_stock_details',$data);
				echo 1;
	}

	public function delete($id){
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$id = base64_decode(urldecode($id));
			$this->db->where('id', $id);
        	$this->db->delete('tbl_stock_details');
		}
	}

	// FOR CATEGORY 

	public function add_category(){
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "stock";
		$data['query'] = $this->db->get_where('tbl_stock_category',array('parent_id'=>0));
		$data['query2'] = $this->db->get('tbl_stock_category');
		$this->load->view('add_stock_category',$data);

	}

	public function do_add_category(){
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
		$this->form_validation->set_rules('cat_name','Category Name','required');
		if($this->form_validation->run() == FALSE){
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i>'.validation_errors().'</div>'; 
		}
		else
		{

			if($this->input->post('parent_id')){ $pid = $this->input->post('parent_id');}else{ $pid = 0; }
			$data = array(
				'parent_id'=> $pid,
				'name'	   =>$this->input->post('cat_name'),	
				'description'	   =>$this->input->post('description'),
				);
			$this->db->insert('tbl_stock_category', $data);
			echo 1;
		}
	}

	public function cat_edit($id)
	{
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		$id = base64_decode(urldecode($id));
		$this->db->where('id', $id);
		$data['query'] = $this->db->get('tbl_stock_category');
		$data['page'] = "stock";
		$this->load->view('edit_stock_category', $data);
	}

	public function do_update_cat($id){
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
		$id = base64_decode(urldecode($id));
		$data = array(
			'name'=>$this->input->post('cat_name'),
			'parent_id'=>$this->input->post('parent_id'),
			'description'=>$this->input->post('description'),
			);
		$this->db->where('id', $id);
		$this->db->update('tbl_stock_category', $data);
		echo 1;
	}

	public function cat_delete($id)
	{
		if (!$this->session->userdata('is_admin_login')) 
		{
           redirect(base_url().'login', 'refresh');
        }
		$id = base64_decode(urldecode($id));
		$this->db->where('id', $id);
		$this->db->delete('tbl_stock_category');
	}
}
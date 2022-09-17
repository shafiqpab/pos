<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('warehouse',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "warehouse";
		$this->load->view('add_warehouse',$data);
	}

	public function do_add(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
		$sql = $this->db->get_where('tbl_warehouse',array('warehouse'=>$this->input->post('warehouse')));
		if($sql->num_rows()==0){
			$this->form_validation->set_rules('warehouse', 'Warehouse Name', 'required');
			if($this->form_validation->run() == FALSE){
				echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i> '.validation_errors().'</div>';
			}else{
				$data=array(
					'warehouse'=>$this->input->post('warehouse'),
					'insert_by'=>$this->session->userdata('id')
					);
				$this->db->insert('tbl_warehouse',$data);
				echo 1;
			}
		}
		else{
			echo '<div class="alert alert-danger"><i class="icon fa fa-ban"></i><strong>Oops, </strong>'.$this->input->post('warehouse').' already used. Please try another one.</div>';
		}
	}

	public function view(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "warehouse";
		$data['query'] = $this->db->get('tbl_warehouse');
		$this->load->view('view_warehouse',$data);
	}

	public function edit(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "stock";
        $id = $this->uri->segment(3);
        $data['query'] = $this->db->get_where('tbl_warehouse',array('id'=>$id));
        $this->load->view('edit_warehouse',$data);
	}
	public function do_update(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $id = $this->uri->segment(3);
        $data=array(
			'warehouse'=>$this->input->post('warehouse'),
			'update_by' 	=> $this->session->userdata('id'),
			'update_date' 	=> date('Y-m-d H:i:s')
			);
		$this->db->where('id', $id);
		$this->db->update('tbl_warehouse',$data);
		echo 1;
	}

	public function delete(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $this->uri->segment(3);
			$this->db->where('id', $id);
        	$this->db->delete('tbl_warehouse');
		}
	}	
}
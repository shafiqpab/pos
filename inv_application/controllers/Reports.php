<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        if( !$this->inventory->check_permission('reports',$this->session->userdata('id')) ){
        	redirect(base_url().'no_access', 'refresh');
        }
	}

	public function index()
  {
		if (!$this->session->userdata('is_admin_login')) 
    {
      redirect(base_url().'login', 'refresh');
    }
    $data['query'] = $this->db->get('tbl_accounts');
    $data['page'] = "reports";
		$this->load->view('search_sales_report',$data);
	}

	public function view_sales_report()
  {
		if (!$this->session->userdata('is_admin_login')) 
    {
      redirect(base_url().'login', 'refresh');
    }
    $cid = $this->input->post('customer_id');
    $date_from = $this->input->post('date-from');
    $date_to = $this->input->post('date-to');
    $sql="SELECT * FROM tbl_stock_sales";
    $where = array();
       if(!empty($cid)) $where[] = "customer_id=$cid";

       if(empty($date_from) && !empty($date_to)) $where[] = "date='.$date_to.'";

       if(!empty($date_from) && empty($date_to)) $where[] = "date='.$date_from.'";

       if(!empty($date_from) && !empty($date_to)) $where[] = "date BETWEEN '.$date_from.' AND '.$date_to.'";

       if(count($where)){ $sql.=' WHERE '.implode(' AND ', $where);} 
       //echo $sql;

       $data['result'] = $this->db->query($sql);
       $data['page'] = "reports";
       $this->load->view('view_sales_report',$data);

	}

  public function purchase_report()
  {
    if (!$this->session->userdata('is_admin_login')) 
    {
       redirect(base_url().'login', 'refresh');
    }
    // $data['result'] = '';
    $data['page'] = "reports";
    $this->load->view('view_purchase_report',$data);
  }

	public function view_purchase_report()
  {
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $cid = $this->input->post('supplier_id');
        $date_from = $this->input->post('date-from');
        $date_to = $this->input->post('date-to');
        $sql="SELECT * FROM tbl_stock_entries";
        $where = array();
           if(!empty($cid)) $where[] = "stock_supplier_name=$cid";

           if(empty($date_from) && !empty($date_to)) $where[] = "date='.$date_to.'";

           if(!empty($date_from) && empty($date_to)) $where[] = "date='.$date_from.'";

           if(!empty($date_from) && !empty($date_to)) $where[] = "date BETWEEN '.$date_from.' AND '.$date_to.'";

           if(count($where)){ $sql.=' WHERE '.implode(' AND ', $where);} //echo $sql;

           $data['result'] = $this->db->query($sql);
           $data['page'] = "reports";
           $this->load->view('view_purchase_report',$data);

	}

  public function stock_report()
  {
    if (!$this->session->userdata('is_admin_login')) 
    {
       redirect(base_url().'login', 'refresh');
    }
    // $data['result'] = '';
    $data['page'] = "reports";
    $this->load->view('view_purchase_stock_report',$data);
  }

	public function view_purchase_stock_report()
  {
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $cid = $this->input->post('stock_id');
        $date_from = $this->input->post('date-from');
        $date_to = $this->input->post('date-to');
        $sql="SELECT * FROM tbl_stock_details";
        $where = array();
           if(!empty($cid)) $where[] = "id=$cid";

           if(empty($date_from) && !empty($date_to)) $where[] = "date='.$date_to.'";

           if(!empty($date_from) && empty($date_to)) $where[] = "date='.$date_from.'";

           if(!empty($date_from) && !empty($date_to)) $where[] = "date BETWEEN '.$date_from.' AND '.$date_to.'";

           if(count($where)){ $sql.=' WHERE '.implode(' AND ', $where);} //echo $sql;

           $data['result'] = $this->db->query($sql);
           $data['page'] = "reports";
           $this->load->view('view_purchase_stock_report',$data);

	}

  public function laser_report()
  {
    if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $cid = $this->input->post('stock_id');
        $date_from = $this->input->post('date-from');
        $date_to = $this->input->post('date-to');
        $sql="SELECT * FROM tbl_stock_details";
        $where = array();
           if(!empty($cid)) $where[] = "id=$cid";

           if(empty($date_from) && !empty($date_to)) $where[] = "date='.$date_to.'";

           if(!empty($date_from) && empty($date_to)) $where[] = "date='.$date_from.'";

           if(!empty($date_from) && !empty($date_to)) $where[] = "date BETWEEN '.$date_from.' AND '.$date_to.'";

           if(count($where)){ $sql.=' WHERE '.implode(' AND ', $where);} //echo $sql;

           $data['result'] = $this->db->query($sql);
           $data['page'] = "reports";
           $this->load->view('view_purchase_stock_report',$data);

  }

  public function account_statement(){
    if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }

        $data['page'] = "reports";
        $this->load->view('view_account_statement',$data);

  }

  public function do_search(){
    if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh'); 
        }

        $acid = $this->input->post('account_id');
        $date_from = $this->input->post('from_date');
        $date_to = $this->input->post('to_date');
        $sql="SELECT * FROM tbl_transactions";
        $where = array();
          if(!empty($acid)) $where[] = "account_id=$acid";

          if(empty($date_from) && !empty($date_to)) $where[] = "date='.$date_to.'";

          if(!empty($date_from) && empty($date_to)) $where[] = "date='.$date_from.'";

          if(!empty($date_from) && !empty($date_to)) $where[] = "date BETWEEN '.$date_from.' AND '.$date_to.'";

          if(count($where)){ $sql.=' WHERE '.implode(' AND ', $where);} //echo $sql;

          $data['query'] = $this->db->query($sql);

          $data['page'] = "reports";
          $this->load->view('account_statement_search_result',$data);

  }

	
}
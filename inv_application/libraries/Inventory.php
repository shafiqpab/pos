<?php 

class Inventory 
{
	protected $CI;

	function __construct()
	{
		$this->CI =& get_instance();
        $this->CI->load->database();
	}

	public function get_parent($pid){
		if($pid != 0 ){
		$sql = $this->CI->db->get_where('tbl_stock_category', array('id'=>$pid));
		$res = $sql->result();
		return $res[0]->name;
	}
		return FALSE;
	}

	public function get_stock_category($pid){
		$query = $this->CI->db->get_where('tbl_stock_category', array('parent_id'=>0));
		foreach($query->result() as $row){
			echo '<option '.( $row->id == $pid  ? "selected" : "").' value="'.$row->id.'">'.$row->name.'</option>';
		}
	}
	// GETTING SUPPLIER  NAME AS DROP DOWN
	public function get_supplier($sid = NULL){
		$this->CI->db->order_by('id');
		$query = $this->CI->db->get('tbl_supplier');
		
		foreach($query->result() as $row){
			echo '<option '.( $row->id == $sid  ? "selected" : "").' value="'.$row->id.'">'.$row->name.'</option>';
		}
	
	}
	// GETTING SINGLE SUPPLIER NAME
	public function get_supplier_name($sid){
		$query = $this->CI->db->get_where('tbl_supplier',array('id'=>$sid));
		$res = $query->result();
		echo @$res[0]->name;
	}

	// GETTING SUPPLIER  NAME AS DROP DOWN
	public function get_customer($sid = NULL){
		$this->CI->db->order_by('id');
		$query = $this->CI->db->get('tbl_customer');
		
		foreach($query->result() as $row){
			echo '<option '.( $row->id == $sid  ? "selected" : "").' value="'.$row->id.'">'.$row->name.'</option>';
		}
	
	}

	// GETTING SUPPLIER  NAME AS DROP DOWN
	public function get_warehouse($sid = NULL){
		$this->CI->db->order_by('id');
		$query = $this->CI->db->get('tbl_warehouse');
		
		foreach($query->result() as $row){
			echo '<option '.( $row->id == $sid  ? "selected" : "").' value="'.$row->id.'">'.$row->warehouse.'</option>';
		}
	
	}

	// GETTING SINGLE CATEGORY NAME
	public function get_stock_category_name($cid){
		
      
      $query = $this->CI->db->get_where('tbl_stock_category', array('id'=>$cid));
      $row = $query->result();
      echo @$row[0]->name;
	}

	//SHOW SELECT OPTION WITH OPT GROUP
	public function get_all_stock_category($selected_id = NULL){
		
      $this->CI->db->order_by('id');  
      $query = $this->CI->db->get_where('tbl_stock_category', array('parent_id'=>0));
      $numRows = $query->num_rows();
      if($numRows > 0){
				
			foreach($query->result() as $row) {
				echo "\n";
				echo "<optgroup label='{$row->name}'>";
				$this->menu_showNested($row->id, $selected_id);
				echo "</optgroup>\n";
			}
      	}
	}

	public function menu_showNested($parentID, $selected_id){
      $this->CI->db->order_by('id');  
      $query = $this->CI->db->get_where('tbl_stock_category', array('parent_id'=>$parentID));
      $numRows = $query->num_rows();
      if($numRows > 0){
         
	      $res = $query->result();
	      foreach ($res as $row){
	            echo "<option ".($selected_id == $row->id ? 'selected' : '')." value='{$row->id}'>\n";
	                echo $row->name;
	                // Run this function again (it would stop running when the mysql_num_result is 0
	                $this->menu_showNested($row->id, $selected_id);
	            echo "</option>\n";
	      	}
      
      	}
    }

    public function get_module_list(){
    	
    	$sql = $this->CI->db->get('tbl_modules');
    	$row = $sql->result();
    	return $row;
    }

    public function get_modules_grants($employee_id){
    		$data = array();
    	 	$query = $this->CI->db->get_where('tbl_grants',array('person_id'=>$employee_id));
    	 	foreach ($query->result() as $permission) {
    	 		$data[] = $permission->permission_id;
    	 	}
    	 	return $data;
    }

    public function check_permission($module_id = NULL,$employee_id = NULL){

    	$query = $this->CI->db->get_where('tbl_grants',array('person_id'=>$employee_id, 'permission_id'=>$module_id));
    	if( $query->num_rows() == 1 ){
    		return true;
    	}else{
    		return false;
    	}

    }

    // GETTING ACCOUNT NAME
	public function get_accounts( $ac_id = NULL ){

		$this->CI->db->order_by('account_id');
		$query = $this->CI->db->get('tbl_accounts');
		
		foreach($query->result() as $row){
			echo '<option '.( $row->account_id == $ac_id  ? "selected" : "").' value="'.$row->account_id.'">'.$row->acoount_name.'</option>';
		}
	}
	// GETTING SINGLE ACCOUNT NAME
	public function get_single_accounts( $ac_id ){

		$query = $this->CI->db->get_where('tbl_accounts',array('account_id'=>$ac_id));
		$row = $query->result();
		return $row[0]->acoount_name;
	}

	// GETTING SINGLE ACCOUNT NAME
	public function get_item_name( $id ){

		$query = $this->CI->db->get_where('tbl_stock_details',array('id'=>$id));
		$row = $query->result();
		return $row[0]->stock_name;
	}

	// GETTING ACCOUNT BALANCE
	public function get_balance( $ac_id ){

		$query = $this->CI->db->get_where('tbl_accounts',array('account_id'=>$ac_id));
		$row = $query->result();
		return $row[0]->initial_balance;
	}


	public function check_payment_status($tid, $type){

		if($type=='sales'){
		$this->CI->db->group_by('transactionid');	
		$sql = $this->CI->db->get_where('tbl_stock_sales',array('transactionid'=>$tid));
		$res = $sql->result();
		$grand_total = $res[0]->grand_total;
		$due =  $res[0]->due;
		$payment =  $res[0]->payment;
		}
		if($type=='purchase'){
		$this->CI->db->group_by('salesid');	
		$sql = $this->CI->db->get_where('tbl_stock_entries',array('salesid'=>$tid));
		$res = $sql->result();
		$grand_total = $res[0]->total;
		$due =  $res[0]->due;
		$payment =  $res[0]->payment;
		}
		if($payment == $grand_total){
			return '<button type="button" class="btn btn-info">Paid</button>';
		}elseif($payment == 0){
			return '<button type="button" class="btn btn-danger">Unpaid</button>'; 
		}else{
			return '<button type="button" class="btn btn-primary">Partial Paid</button>';
		}

	}

	public function get_payment_mood($tid){
		$query = $this->CI->db->limit(1);
		$query = $this->CI->db->get_where('tbl_stock_entries', array('salesid'=>$tid));
		$row = $query->result();
		return $row[0]->mode;
	}

	public function get_payment_mood_sales($tid){
		$query = $this->CI->db->limit(1);
		$query = $this->CI->db->get_where('tbl_stock_sales', array('transactionid'=>$tid));
		$row = $query->result();
		return $row[0]->mode;
	}

	public function get_company_info($type){
		return $this->CI->db->get_where('tbl_settings' , array('type' =>$type))->row()->description;
	}

	public function get_supplier_info($tid){
		$query = $this->CI->db->limit(1);
		$query = $this->CI->db->get_where('tbl_stock_entries', array('salesid'=>$tid));
		$row = $query->result();
		$supplier_id = $row[0]->supplier_id;
		$sql = $this->CI->db->get_where('tbl_supplier' , array('id' =>$supplier_id));
		return $sql->result();
	}

	public function get_customer_info($tid){
		$query = $this->CI->db->limit(1);
		$query = $this->CI->db->get_where('tbl_stock_sales', array('transactionid'=>$tid));
		$row = $query->result();
		$customer_id = $row[0]->customer_id;
		$sql = $this->CI->db->get_where('tbl_customer' , array('id' =>$customer_id));
		return $sql->result();
	}

	public function get_total_payment($tid){
		$query = $this->CI->db->select_sum('payment', 'Amount');
		$query = $this->CI->db->where('transaction_id', $tid);
		$query = $this->CI->db->get('tbl_transactions');
		$result = $query->result();
		$total_paid = $result[0]->Amount;
		return $total_paid;
	}

	 // for pdf gerate
    public function generate_pdf($html,$fname){
        $this->CI->load->library('m_pdf');
        $this->CI->m_pdf->pdf->SetDisplayMode('fullpage');
        //$this->CI->m_pdf->pdf->defaultPageNumStyle = 'i';
        //$this->CI->m_pdf->pdf->mirrorMargins = 1;
        $this->CI->m_pdf->pdf->SetWatermarkText('BIMS');
        $this->CI->m_pdf->pdf->watermark_font = 'DejaVuSansCondensed';
        $this->CI->m_pdf->pdf->showWatermarkText = true;
        
        //$this->CI->m_pdf->pdf->WriteHTML($style,1);
        
        //generate the PDF from the given html
		$this->CI->m_pdf->pdf->WriteHTML($html);

	        //download it.
		$this->CI->m_pdf->pdf->Output($fname, "D");	
    }

    public function check_stock($stock_id, $level){
    	$query = $this->CI->db->get_where('tbl_stock_details', array('id'=>$stock_id));
    	$res = $query->result();
    	if($res[0]->stock_quatity <= $level){
    		return 'style="background:#ff2222;color:#ffffff"';
    	}
    }

    public function get_stock($stock_id){
    	$query = $this->CI->db->get_where('tbl_stock_details', array('id'=>$stock_id));
    	$res = $query->result();
    	return $res[0]->stock_quatity;
    }

    public function get_month_name(){
    	// FOR MONTH INCREMENT
    	/*for ($i =0; $i < 6; $i++) {
	    $months[] = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));
		}*/

		for ($i = 5; $i >= 0; $i--) {
	    $months[] = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));
		}

		return $months;
    }

}
?>
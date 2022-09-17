<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('highcharts');
	}

	public function index(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        // for graph
        $data['charts'] = $this->pie();
        $data['balance'] = $this->pie2();
        $data['bar'] = $this->bar();

        // $this->db->group_by('transactionid');

        $data['query'] = $this->db->get('tbl_stock_sales');
        $data['page'] = "dashboard";
		$this->load->view('dashboard',$data);
	}
	public function change_password(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = "dashboard";
		$this->load->view('change_password',$data);
	}

	public function do_pass_update(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $this->form_validation->set_rules('cur_pass', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|max_length[16]|min_length[6]');
		$this->form_validation->set_rules('retype_pass', 'Retype Password', 'trim|required|matches[new_pass]');

		if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('msg','<div class="alert alert-danger">'.validation_errors().'</div>');   
        redirect(base_url().'dashboard/change_password','refresh');  
        }else{

        	$sql = $this->db->get_where('tbl_users', array('password'=>$this->input->post('cur_pass')));
        	if( $sql->num_rows() == 1 ){

        		$this->db->where('id', $this->session->userdata('id'));
        		$this->db->update('tbl_users', array('password'=>$this->input->post('new_pass')));
        		$this->session->set_flashdata('msg','<div class="alert alert-success">Your password has been changed.</div>');   
        		redirect(base_url().'dashboard/change_password','refresh');

        	}else{
        		$this->session->set_flashdata('msg','<div class="alert alert-danger">Current password miss match</div>');   
        		redirect(base_url().'dashboard/change_password','refresh');  
        	}
        }
		$this->load->view('change_password');
	}

	public function settings(){
		if (!$this->session->userdata('is_admin_login')) {
           redirect(base_url().'login', 'refresh');
        }
        $data['page'] = 'settings';
		$this->load->view('settings', $data);
	}

	public function do_settings_update(){
            
        $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('tbl_settings' , $data);
        
        $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('tbl_settings' , $data);
        
        $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('tbl_settings' , $data);
        
        $data['description'] = $this->input->post('system_mobile');
            $this->db->where('type' , 'system_mobile');
            $this->db->update('tbl_settings' , $data);
        
        $data['description'] = $this->input->post('system_address');
            $this->db->where('type' , 'system_address');
            $this->db->update('tbl_settings' , $data);
        
            redirect(base_url().'dashboard/settings','refresh');
           
    }

    /**
     * pie function.
     * Draw a Pie, and run javascript callback functions
     * 
     * @access public
     * @return void
     */
    function pie()
    {
        // for pie chart
        $serie['data']  = array(
            array('Income', 70), 
            array('Expense', 30)
        );
        $callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
        
        @$tool->formatter = $callback;
        @$plot->pie->dataLabels->formatter = $callback;
        
        $this->highcharts->set_title('Income VS Expense', 'This month'); // set
        $this->highcharts
            ->set_type('pie')
            ->set_serie($serie)
            ->set_tooltip($tool)
            ->set_plotOptions($plot);

        @$credits->href = '';
        @$credits->text = "Shop Cart";    
        $this->highcharts->set_credits($credits);    
        
        $data = $this->highcharts->render();
        return $data;

    }
    // for payable and receiveable amount
    function pie2()
    {
        // for pie chart
        $serie['data']  = array(
            array('Receiveable', 55), 
            array('Payable', 45)
        );
        $callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
        
        @$tool->formatter = $callback;
        @$plot->pie->dataLabels->formatter = $callback;
        
        $this->highcharts->set_title('Receiveable VS Payable Amount', 'This month'); // set
        $this->highcharts
            ->initialize('chart_template') // load template 
            ->set_type('pie')
            ->set_serie($serie)
            ->set_tooltip($tool)
            ->set_plotOptions($plot);

        @$credits->href = '';
        @$credits->text = "BIMS";    
        $this->highcharts->set_credits($credits);    
        
        $data = $this->highcharts->render();
        return $data;

    }

    /**
     * categories function.
     * Lets go for a real world example
     */
    function bar()
    {       
        
        $graph_data = $this->_data();
            
    
        $this->highcharts->set_type('column'); // drauwing type
        $this->highcharts->set_title('Income VS Expense', 'All over the year'); // set chart title: title, subtitle(optional)
        $this->highcharts->set_axis_titles('Month', 'Money'); // axis titles: x axis,  y axis
        
        $this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
        $this->highcharts->set_serie($graph_data['users']); // the first serie
        $this->highcharts->set_serie($graph_data['popul']); // second serie
        
        // we can user credits option to make a link to the source article. 
        // it's possible to pass an object instead of array (but object will be converted to array by the lib)
        @$credits->href = '';
        @$credits->text = "BIMS";
        $this->highcharts->set_credits($credits);
        
        $this->highcharts->render_to('my_div'); // choose a specific div to render to graph
        
        $data = $this->highcharts->render(); // we render js and div in same time
       return $data; 
    }
    

    function _data()
    {
        $data['users']['data'] = array(6000, 4500, 7000, 7500, 8000, 9500);
        $data['users']['name'] = 'Income';
        $data['popul']['data'] = array(800, 1300, 1000, 1500, 500, 1800);
        $data['popul']['name'] = 'Expense';
        $data['axis']['categories'] = $this->inventory->get_month_name();
        
        return $data;
    }

}